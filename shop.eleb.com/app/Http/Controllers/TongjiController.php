<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\DataCollector\DumpDataCollector;

class TongjiController extends Controller
{
    public function __construct()
    {
        //制定当前控制器使用的中间件
        // auth表示必须通过登录认证
        $this->middleware('auth'
        //配置  只对哪些方法生效
        //'only'=>[],
        //不对哪些方法生效

        );
    }

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
            $$month = Order::where('shop_id', Auth::user()->id)->whereDate('created_at', 'like', "%$month%")->count();
            $months[$month] = $$month;
        }
        return view('tongji.month', compact('months'));
    }

    //统计一周内菜品销量
    public function menu_week()
    {
        $shop_id = Auth::user()->id;
        $start_time = date("Y-m-d", strtotime("-6 day"));
        $end_time = date("Y-m-d 23:59:59");
//        return [$start_time, $end_time];
        //菜品名称    时间    销量
        //order_details  orders
//        $sql = "select order_details.goods_name as `name`,date(orders.create_at) as `date` ,sum(order_details.amount) as total
//                from order_details
//                join orders on order_details.order_id = orders.id
//                where BETWEEN '$start_time' AND  '$end_time' AND orders.shop_id = $shop_id
//                GROUP BY `date`,`name`";


        $sql = "SELECT
	DATE(orders.created_at) AS date,order_details.goods_name,
	SUM(order_details.amount) AS total
FROM
	order_details
JOIN orders ON order_details.order_id = orders.id
WHERE
	 orders.created_at >= '{$start_time}' AND orders.created_at <= '{$end_time}'
AND shop_id = {$shop_id}
GROUP BY
	DATE(orders.created_at),order_details.goods_name";
        $rows = DB::select($sql);
        dd($rows);
    }
}
