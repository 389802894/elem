<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;

class EventPrizeController extends Controller
{
    //奖品列表
    public function index()
    {
        $event_prizes = EventPrize::all();
        return view('eventPrize.index', compact('event_prizes'));
    }

    //添加
    public function create()
    {
        $events = Event::all();
//        return $events;
        return view('eventPrize.create', compact('events'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            ['events_id' => 'required',
                'name' => 'required',
                'description' => 'required',
            ]);
        EventPrize::create([
            'events_id' => $request->events_id,
            'name' => $request->name,
            'description' => $request->description,
            'member_id' => ''
        ]);
        return redirect()->route('event_prizes.index');
    }

    public function show()
    {
    }

    //修改
    public function edit(EventPrize $eventPrize)
    {
        $events = Event::all();
        return view('eventPrize.edit', compact('eventPrize', 'events'));
    }

    public function update(Request $request, EventPrize $eventPrize)
    {
        $this->validate($request,
            ['events_id' => 'required',
                'name' => 'required',
                'description' => 'required',
            ]);
        $eventPrize->update([
            'events_id' => $request->events_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('event_prizes.index');
    }

    //删除
    public function destroy(EventPrize $eventPrize)
    {
        $eventPrize->delete();
        return redirect()->route('event_prizes.index')->with('success', '删除成功');
    }
}
