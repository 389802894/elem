<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

//管理员管理
class AdminController extends Controller
{
    //管理员列表
    public function index()
    {
        $admins = Admin::all();
        return view('admin.index', compact('admins'));

    }

    //管理员注册
    public function create()
    {
        $roles = Role::all();
        return view('admin.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            ['name' => 'required', 'email' => 'required', 'password' => 'required'],
            ['name.required' => '用户名不能为空', 'email.required' => '邮箱不能为空', 'password' => '密码不能为空']);
        $admin = Admin::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password)]);
        //添加角色
        $admin->syncRoles($request->role);
        return redirect()->route('admins.index')->with('success', '管理员添加成功');
    }

    //修改管理员信息
    public function edit(Admin $admin)
    {
        if ($admin->id != auth()->user()->id) {
            echo "<script>alert('只能修改自己的信息');location.href='http://admin.eleb.com/admins';</script>";
        }
        $roles = Role::all();
        return view('admin.edit', compact('admin', 'roles'));
    }

    public function update(Request $request, Admin $admin)
    {
        $this->validate($request,
            ['name' => 'required', 'email' => 'required'],
            ['name.required' => '用户名不能为空', 'email.required' => '邮箱不能为空']);
        $admin->update(['name' => $request->name, 'email' => $request->email]);
        //更改角色
        $admin->syncRoles($request->role);
        return redirect()->route('admins.index')->with('success', '修改成功');
    }

    public function show()
    {
    }

    //删除管理员
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')->with('success', '删除成功');
    }
}
