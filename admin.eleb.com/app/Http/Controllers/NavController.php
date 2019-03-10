<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class NavController extends Controller
{

    //菜单首页
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {
            $navs = Nav::where('name', 'like', "%$keyword%")->paginate(10);
        } else {
            $navs = Nav::paginate(10);
        }
        return view('nav.index', compact('navs', 'keyword'));
    }

    //添加菜单
    public function create()
    {
        $navs = Nav::where('pid',0)->get();
        $permissions = Permission::all();
        return view('nav.create', compact('navs','permissions'));
    }

    public function store(Request $request)
    {
//        return $request;
        $this->validate($request,
            ['name' => 'required'],
            ['name.required' => '导航名称不能为空']);
        $nav = new Nav();
        $nav->permission_id = $request->permission;
        $nav->name = $request->name;
        $nav->pid = $request->pid;
        if ($request->pid == 0) {
            $nav->url = '';
        } else {
            $nav->url = $request->url;
        }
        $nav->save();
        return redirect()->route('navs.index')->with('success', '添加导航成功');
    }

    //修改菜单
    public function edit(Nav $nav)
    {
        $navs = Nav::where('pid',0)->get();
        $permissions = Permission::all();
        return view('nav.edit', compact('nav', 'navs','permissions'));
    }

    public function update(Request $request, Nav $nav)
    {
        $this->validate($request,
            ['name' => 'required'],
            ['name.required' => '导航名称不能为空']);
        $nav->permission_id = 0;
        $nav->name = $request->name;
        $nav->pid = $request->pid;
        if ($request->pid == 0) {
            $nav->url = '';
        } else {
            $nav->url = $request->url;
        }
        $nav->save();
        return redirect()->route('navs.index')->with('success', '修改成功');
    }

    //删除菜单
    public function destroy(Nav $nav)
    {
        $nav->delete();
        return redirect()->route('navs.index')->with('success', '删除成功');
    }
}
