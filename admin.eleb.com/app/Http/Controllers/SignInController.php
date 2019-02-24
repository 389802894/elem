<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function __construct()
    {
        //只能游客才能访问
        $this->middleware('guest', [
            'only' => ['create']
        ]
        );
    }

    //登录界面
    public function create()
    {
        return view('signin.index');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            ['name' => 'required', 'password' => 'required']
        );
        if (Auth::attempt([
            'name' => $request->name,
            'password' => $request->password],
            $request->has('rememberMe'))
        ) {
            return redirect()->route('admins.index')->with('success', '登录成功');
        } else {
            return back()->with('danger', '账号或密码错误');
        }
    }

    //注销
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login')->with('success','您已安全退出');
    }
}
