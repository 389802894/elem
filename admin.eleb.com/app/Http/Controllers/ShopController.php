<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class ShopController extends Controller
{
    //商家首页
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {
            $shops = Shop::where('shop_name', 'like', '%$keyword%')->paginate(5);
        } else {
            $shops = Shop::paginate(5);
        }
        return view('shop.index', compact('shops', 'keyword'));
    }

    //添加商家
    public function create()
    {
        //获取所有分类
        $shopCategories = ShopCategory::all();
        return view('shop.create', compact('shopCategories'));
    }

    public function store(Request $request)
    {
//        dd($request->email);
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
        DB::beginTransaction();
        try {
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
            $shop->status = 1;
            $shop->save();
            //保存商家信息
            $shopUser = new ShopUser();
            $shopUser->name = $request->name;
            $shopUser->email = $request->email;
            $shopUser->password = Hash::make($request->password);
            $shopUser->status = 1;
            $shopUser->shop_id = $shop->id;
            $shopUser->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }



        return redirect()->route('shops.index')->with('success', '添加商家成功');
    }

    //修改商家信息
    public function edit(Shop $shop)
    {
        $shopCategories = ShopCategory::all();
        return view('shop.edit', compact('shop', 'shopCategories'));
    }

    public function update(Request $request, Shop $shop)
    {
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
            ],
            ['shop_name.required' => '店铺名称不能为空',
                'shop_img.image' => '图片格式有错',
                'start_send.required' => '起送金额不能为空',
                'send_cost.required' => '配送费不能为空',
                'notice,required' => '公告不能为空',
                'discount.required' => '优惠信息不能为空',
            ]);
        $img = $request->file('shop_img');
        if ($img) {
            $path = $img->store('public/shop');
            $shop->shop_img = $path;
        }
        $shop->shop_name = $request->shop_name;
        $shop->shop_category_id = $request->shop_category_id;
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
        $shop->status = 1;
        $shop->save();
        return redirect()->route('shops.index')->with('success', '修改成功');
    }

    //查看
    public function show()
    {

    }

    //删除
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('shops.index')->with('success', '删除成功');
    }

    //重置密码
    public function reset(Shop $shop)
    {
        $shopUsers = ShopUser::all();
        foreach ($shopUsers as $shopUser) {
            if ($shopUsers->shop_id == $shop->id) {
                $shopUsers->update();
            }
        }
        return redirect()->route('shops.index')->with('success', '密码重置成功为888888');
    }

}
