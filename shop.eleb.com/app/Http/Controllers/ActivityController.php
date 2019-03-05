<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

//查看平台活动
class ActivityController extends Controller
{
    //查看活动列表
    public function index()
    {

        $activities = Activity::where('end_time','>',time())->get();
//        dd($activities);
        return view('activity.index',compact('activities'));
    }

    //查看详情
    public function show(Activity $activity)
    {
        return view('activity.show',compact('activity'));
    }
}
