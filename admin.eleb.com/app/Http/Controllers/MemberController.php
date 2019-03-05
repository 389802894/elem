<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class MemberController extends Controller
{
    //会员列表

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {
            $members = Member::where('username', 'like', "%$keyword%")->get();
        } else {
            $members = Member::all();
        }

        return view('member.index', compact('members'));
    }

    //查看会员
    public function show(Member $member)
    {
        return view('member.show', compact('member'));
    }

    //禁用会员
    public function destroy(Member $member)
    {
        $member['status']=0;
        $member->save();
        return redirect()->route('members.index')->with('success','禁用成功');
    }
}
