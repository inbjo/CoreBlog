<?php

namespace App\Http\Controllers\Pay;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Notifications\PostWereReward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Yansongda\Pay\Pay;

class WechatController extends Controller
{
    protected $config;

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['pay']]);
        $this->config = config('pay.wechat');
    }

    public function pay(Request $request)
    {
        $order = Order::create([
            'type' => 'reward',
            'no' => time() . rand(1000, 9999),
            'payment_method' => 'wechat',
            'total_amount' => floatval($request->input('total_amount')),
            'remark' => $request->input('remark'),
            'post_id' => $request->input('post_id'),
            'user_id' => auth()->id(),
        ]);
        $order->save();

        $info = [
            'out_trade_no' => $order['no'],
            'body' => '文章打赏 - ' . $order['no'],
            'total_fee' => $order['total_amount'] * 100,
        ];
        $result = Pay::wechat($this->config)->scan($info);

        return ['code' => 0, 'qrcode' => $result->code_url, 'msg' => '创建支付二维码成功'];
    }

    public function notify()
    {
        $pay = Pay::wechat($this->config);

        try {
            $data = $pay->verify(); // 是的，验签就这么简单！

            if ($data->result_code == 'SUCCESS') {
                $order = Order::where('no', $data->out_trade_no)->first();
                if ($order && $order->paid_at == null) {
                    $order->payment_no = $data->transaction_id;
                    $order->paid_at = Carbon::parse($data->time_end)->toDateTimeString();;
                    $order->save();
                    Notification::send($order->post->user, new PostWereReward($order));
                }
            }

        } catch (\Exception $e) {
            $e->getMessage();
        }

        return $pay->success();
    }
}
