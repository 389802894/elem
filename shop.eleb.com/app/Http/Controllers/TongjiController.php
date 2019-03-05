<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TongjiController extends Controller
{
    //统计一周订单数
    public function week()
    {
        $weeks = [];
        for ($i = 0; $i < 7; $i++) {
            $time = date("Y-m-d", strtotime("-$i day"));
            $$time = Order::where('shop_id', Auth::user()->id)->whereDate('created_at', 'like', "%$time%")->count();
            $weeks[$time] = $$time;
        }
        return view('tongji.week', compact('weeks'));
    }

    //统计三个月
    public function month()
    {
        $months = [];
        for ($i = 0; $i < 3; $i++) {
            $month = date("Y-m", strtotime("-$i month"));
            $$month = Order::where('shop_id', Auth::user()->id)->whereDate('created_at','like', "%$month%")->count();
            $months[$month] = $$month;
        }
        return view('tongji.month', compact('months'));
    }
}
