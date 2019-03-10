<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    //活动列表
    public function index()
    {
        $events = Event::all();
        return view('event.index', compact('events'));
    }

    //立即报名
    public function update(Event $event)
    {
        EventMember::create([
            'events_id' => $event->id,
            'member_id' => Auth::user()->id
        ]);
        return redirect()->route('events.index')->with('success', '报名成功');
    }
}
