<?php

namespace App\Http\Controllers\Pay;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $order = Order::create([
            'type' => 'reward',
            'no' => time() . rand(1000, 9999),
            'payment_method' => $request->input('payment'),
            'total_amount' => $request->input('total_amount'),
            'post_id' => $request->input('post_id'),
            'user_id' => auth()->id(),
        ]);
        $order->save();
        return ['code' => 0, 'msg' => '订单生成成功', 'order_id' => $order->id];
    }
}
