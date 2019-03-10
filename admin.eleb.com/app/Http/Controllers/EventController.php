<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use App\Models\EventPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\compare;

//抽奖活动控制器
class EventController extends Controller
{
    //活动列表
    public function index()
    {
        $events = Event::all();
        return view('event.index', compact('events'));
    }

    //添加活动
    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            ['title' => 'required',
                'content' => 'required',
                'signup_start' => 'required',
                'signup_end' => 'required',
                'prize_date' => 'required',
                'signup_num' => 'required',]);
        Event::create([
            'title' => $request->title,
            'content' => $request->input('content'),
            'signup_start' => strtotime($request->signup_start),
            'signup_end' => strtotime($request->signup_end),
            'prize_date' => $request->prize_date,
            'signup_num' => $request->signup_num,
            'is_prize' => 0
        ]);
        return redirect()->route('events.index');
    }

    public function show()
    {

    }

    //修改活动
    public function edit()
    {
    }

    public function update()
    {
    }

    //开奖
    public function destroy(Event $event)
    {
        $event_members = EventMember::where('events_id', $event->id)->get()->toArray();  //查看所有当前活动的报名商家
        shuffle($event_members);  //打乱顺序
        $member = array_pop($event_members);  //弹出最后一个商家
        var_dump($member['member_id']);
        //获取当前活动的所有奖品
        $event_prizes = EventPrize::where('events_id', $event->id)->get()->toArray();
        array_rand($event_prizes, 1);//
        $id = array_rand($event_prizes, 1) + 1;//随机选取一个商品
        var_dump($id);
        DB::table('event_prizes')->where('id',$id)->update(['member_id'=>$member['member_id']]);
        DB::table('events')->where('id',$event->id)->update(['is_prize'=>1]);
        return redirect()->route('event_prizes.index')->with('success','中奖商家id为'.$member['member_id'].'奖品id为'.$id);
    }
}
