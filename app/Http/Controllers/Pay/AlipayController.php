<?php

namespace App\Http\Controllers\Pay;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Notifications\PostWereReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Yansongda\Pay\Pay;

class AlipayController extends Controller
{
    protected $config;

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create']]);
        $this->config = config('pay.alipay');
    }

    public function create(Request $request)
    {
        $order = Order::create([
            'type' => 'reward',
            'no' => time() . rand(1000, 9999),
            'payment_method' => 'alipay',
            'total_amount' => $request->input('total_amount'),
            'remark' => $request->input('remark'),
            'post_id' => $request->input('post_id'),
            'user_id' => auth()->id(),
        ]);
        $order->save();
        return ['code' => 0, 'msg' => '订单生成成功', 'order_id' => $order->hash_id];
    }

    public function pay(Order $order)
    {
        $info = [
            'out_trade_no' => $order['no'],
            'total_amount' => $order['total_amount'],
            'subject' => '文章打赏 - ' . $order['no'],
        ];
        return Pay::alipay($this->config)->web($info);
    }

    public function return()
    {
        $data = Pay::alipay($this->config)->verify(); // 是的，验签就这么简单！
        $order = Order::where('no', $data->out_trade_no)->first();
        if ($order) {
            return redirect()->route('post.show', $order->post->slug)->with('success', '支付打赏成功！');
        } else {
            return redirect()->route('index');
        }
    }

    public function notify()
    {
        $alipay = Pay::alipay($this->config);

        try {
            $data = $alipay->verify(); // 是的，验签就这么简单！

            if ($data->trade_status == 'TRADE_SUCCESS' || $data->trade_status == 'TRADE_FINISHED') {
                $order = Order::where('no', $data->out_trade_no)->first();
                if ($order && $data->total_amount == $order->total_amount && $order->paid_at == null) {
                    $order->payment_no = $data->trade_no;
                    $order->paid_at = $data->gmt_payment;
                    $order->save();
                    Notification::send($order->post->user, new PostWereReward($order));
                }
            }

        } catch (\Exception $e) {
            $e->getMessage();
        }

        return $alipay->success();
    }
}
