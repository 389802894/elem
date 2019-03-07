<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    //角色列表
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {
            $roles = Role::where('name', 'like', "%$keyword%")->paginate(5);
        } else {
            $roles = Role::paginate(5);
        }
        return view('role.index', compact('roles', 'keyword'));
    }

    //添加角色
    public function create()
    {
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            ['name' => 'required'],
            ['name.required' => '角色名称不能为空']);
        //添加角色
        $role = Role::create(['name' => $request->name]);
        //给角色赋予权限
        $role->syncPermissions($request->permission);
        return redirect()->route('roles.index');
    }

    //修改角色
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        //验证数据
        $this->validate($request, ['name' => 'required'], ['name.required' => '权限不能为空']);
        //保存角色
        $role->update(['name' => $request->name]);
        //赋予权限
        $role->syncPermissions($request->permission);
        return redirect()->route('roles.index');

    }

    //查看
    public function show()
    {
    }

    //删除角色
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index');
    }
}
