<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use App\Models\Member;
use App\Models\ShopUser;
use Illuminate\Http\Request;

class EventMemberController extends Controller
{
    public function index(){
        $event_members = EventMember::all();
        $shopUsers = ShopUser::all();
        $events = Event::all();
        return view('eventMember.index',compact('event_members','shopUsers','events'));
    }
}
