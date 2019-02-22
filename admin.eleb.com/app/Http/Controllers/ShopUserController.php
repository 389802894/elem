<?php

namespace App\Http\Controllers;

use App\Models\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ShopUserController extends Controller
{

    public function index()
    {
        //商家账户列表
        $shopUsers = ShopUser::all();
        return view('shopUser.index',compact('shopUsers'));
    }


    //商家账户修改

    public function edit(ShopUser $shopUser)
    {
        return view('shopUser.edit',compact('shopUser'));
    }


    public function update(Request $request, ShopUser $shopUser)
    {
        $this->validate($request,
            ['name'=>'required','email'=>'required']);
        $shopUser->update(['name'=>$request->name,'email'=>$request->email]);
        return redirect()->route('shopUsers.index')->with('success','修改账户信息成功');
    }

    //重置密码
    public function reset(ShopUser $shopUser){
        $shopUser->update(['password'=>Hash::make('888888')]);
        return redirect()->route('shopUsers.index')->with('success','重置密码为888888');
    }
}
