<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SignInController extends Controller
{
    public function __construct()
    {
        //只能游客才能访问
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    //登录界面
    public function create()
    {
        return view('signin.index');
    }

    public function store(Request $request)
    {

        $status = DB::table('shop_users')->select('status')->where('name', '=', $request->name)->get();

        if ($status[0]->status != 1) {
            echo "<script>alert('账号有风险,不能登录');location.href='shopUsers/create';</script>";
            exit;
        }
        $this->validate($request,
            ['name' => 'required', 'password' => 'required']
        );
        if (Auth::attempt([
            'name' => $request->name,
            'password' => $request->password],
            $request->has('rememberMe'))
        ) {
            return view('menu.index');
        } else {
            return back()->with('danger', '账号或密码错误');
        }
    }

    //注销
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', '您已安全退出');
    }

    //修改密码
    public function modify()
    {
        return view('signin.modify');
    }

    //保存新密码
    public function update(Request $request)
    {
        $old_password = $request->old_password;
//        dd(auth()->user());
        if (!Hash::check($old_password, auth()->user()->password)) {
            echo "<script>alert('原密码不正确');location.href='modify';</script>";
        } else {
//                $shopUser = auth()->user();
//                $shopUser::update(['password'=>$request->new_password]);
            auth()->user()->update(['password' => Hash::make($request->new_password)]);
            Auth::logout();
            echo "<script>alert('修改密码成功');location.href='shopUsers/create';</script>";
        }
    }
}
