<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //权限列表
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {
            $permissions = Permission::where('name', 'like', "%$keyword%")->paginate(5);
        } else {
            $permissions = Permission::paginate(5);
        }
        return view('permission.index', compact('permissions', 'keyword'));
    }

    //添加权限
    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            ['name' => 'required'],
            ['name.required' => '权限名称不能为空']);
        Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.index');
    }

    //修改权限
    public function edit(Permission $permission)
    {
        return view('permission.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        //验证数据
        $this->validate($request, ['name' => 'required'], ['name.required' => '权限不能为空']);
        //保存
        $permission->update(['name' => $request->name]);
        return redirect()->route('permissions.index')->with('success', '修改权限成功');

    }

    //查看
    public function show()
    {
    }

    //删除权限
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index');
    }
}
