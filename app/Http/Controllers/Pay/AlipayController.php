<?php

namespace App\Http\Controllers\Pay;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Yansongda\Pay\Pay;

class AlipayController extends Controller
{
    protected $config;

    public function __construct()
    {
        $this->middleware('auth');
        $this->config = config('pay.alipay');
    }

    public function create(Request $request)
    {
        $order = Order::create([
            'type' => 'reward',
            'no' => time() . rand(1000, 9999),
            'payment_method' => 'alipay',
            'total_amount' => $request->input('total_amount'),
            'post_id' => $request->input('post_id'),
            'user_id' => auth()->id(),
        ]);
        $order->save();
        return ['code' => 0, 'msg' => '订单生成成功', 'order_id' => $order->id];
    }

    public function pay($id)
    {
        $order = Order::findOrFail($id);
        $info = [
            'out_trade_no' => $order['no'],
            'total_amount' => $order['total_amount'],
            'subject' => 'test subject - 测试',
        ];
        return Pay::alipay($this->config)->web($info);
    }

    public function return()
    {
        $data = Pay::alipay($this->config)->verify(); // 是的，验签就这么简单！
        return '订单支付成功';
    }

    public function notify()
    {
        $alipay = Pay::alipay($this->config);

        try {
            $data = $alipay->verify(); // 是的，验签就这么简单！

            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
            // 4、验证app_id是否为该商户本身。
            // 5、其它业务逻辑情况

            //todo 支付通知验证
            $order = Order::where('no', $data->out_trade_no)->get();
            if ($order) {
                $order->payment_no = $data->trade_no;
                $order->paid_at = Carbon::now();
                $order->save();
            } else {
                abort(403);
            }

            Log::debug('Alipay notify', $data->all());
        } catch (\Exception $e) {
            $e->getMessage();
        }

        return $alipay->success();
    }
}
