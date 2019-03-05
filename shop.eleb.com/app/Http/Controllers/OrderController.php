<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //订单列表
    public function index()
    {
        $orders = Order::all();
        return view('order.index', compact('orders'));
    }

    //查看订单
    public function show(Order $order)
    {
        return view('order.show', compact('order'));
    }

    //取消订单
    public function destroy(Order $order)
    {
        $order['status'] = -1;
        $order->save();
        return redirect()->route('orders.index')->with('success', '取消成功');
    }

    //发货
    public function update(Order $order)
    {
        $order['status'] = 2;
        $order->save();
        return redirect()->route('orders.index')->with('success', '发货成功');
    }
}
