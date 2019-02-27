<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {

        $keyword = $request->keyword;
        $wheres = [];
        if ($keyword){
            if ($keyword==1) {$wheres[]=['end_time','>',time()];
                $wheres[]=['start_time','<',time()];
            }
            if ($keyword==2) $wheres[]=['start_time','>',time()];
            if ($keyword==-1) $wheres[]=['end_time','<',time()];
            $activities = Activity::where($wheres)->get();
        }else{
            $activities = Activity::all();
        }
        return view('activity.index', compact('activities','keyword'));
    }

    public function create()
    {
        return view('activity.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            ['title' => 'required',
                'content' => 'required',
                'start_time' => 'required',
                'end_time' => 'required']
        );
        Activity::create(['title' => $request->title, 'content' => $request->input('content'),
            'start_time' => strtotime($request->start_time), 'end_time' => strtotime($request->end_time)
        ]);
        return redirect()->route('activities.index')->with('success', '添加活动成功');
    }

    public function edit(Activity $activity)
    {
        return view('activity.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $this->validate($request,
            ['title' => 'required',
                'content' => 'required',
                'start_time' => 'required',
                'end_time' => 'required']
        );
        $activity->update(['title' => $request->title, 'content' => $request->input('content'),
            'start_time' => $request->start_time, 'end_time' => $request->end_time
        ]);
        return redirect()->route('activities.index')->with('success', '修改活动成功');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activities.index')->with('success', '删除活动成功');
    }
}
