<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

//商家端
class ShopUserController extends Controller
{
    //商家注册
    public function create()
    {
        $shopCategories = ShopCategory::all();

        return view('shopUser.create', compact('shopCategories'));
    }

    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,
            ['shop_name' => 'required',
                'shop_img' => 'image',
                'brand' => 'required',
                'on_time' => 'required',
                'fengniao' => 'required',
                'bao' => 'required',
                'zhun' => 'required',
                'start_send' => 'required',
                'send_cost' => 'required',
                'notice' => 'required',
                'discount' => 'required',
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'],
            ['shop_name.required' => '店铺名称不能为空',
                'shop_img.image' => '图片格式有错',
                'start_send.required' => '起送金额不能为空',
                'send_cost.required' => '配送费不能为空',
                'notice,required' => '公告不能为空',
                'discount.required' => '优惠信息不能为空',
                'name.required' => '商家名称不能为空',
                'email.required' => '邮箱不能为空',
                'password.required' => '密码不能为空'
            ]);
        //获取图片,保存到服务器
        $img = $request->file('shop_img');
        if ($img) {
            $path = $img->store('public/shop');
        } else {
            $path = '';
        }
        //保存店铺数据
        $shop = new Shop();
        $shop->shop_name = $request->shop_name;
        $shop->shop_category_id = $request->shop_category_id;
        $shop->shop_img = $path;
        $shop->shop_rating = 4.5;
        $shop->brand = $request->brand;
        $shop->on_time = $request->on_time;
        $shop->fengniao = $request->fengniao;
        $shop->bao = $request->bao;
        $shop->piao = $request->piao;
        $shop->zhun = $request->zhun;
        $shop->start_send = $request->start_send;
        $shop->send_cost = $request->send_cost;
        $shop->notice = $request->notice;
        $shop->discount = $request->discount;
        $shop->status = 0;
        $shop->save();
        //保存商家信息
        $shopUser = new ShopUser();
        $shopUser->name = $request->name;
        $shopUser->email = $request->email;
        $shopUser->password = Hash::make($request->password);
        $shopUser->status = 1;
        $shopUser->shop_id = $shop->id;
        $shopUser->save();

        return redirect()->route('shops.create')->with('success', '商家注册成功');
    }
}
