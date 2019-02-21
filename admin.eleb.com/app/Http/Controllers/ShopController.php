<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //商家首页
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if($keyword){
            $shops = Shop::where('shop_name','like','%$keyword%')->paginate(5);
        }else{
            $shops = Shop::paginate(5);
        }
        return view('shop.index',compact('shops','keyword'));
    }

    //添加商家
    public function create()
    {
        //获取所有分类
        $shopCategories = ShopCategory::all();
        return view('shop.create',compact('shopCategories'));
    }

    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,
            ['shop_name'=>'required',
                'shop_img'=>'image',
                'brand'=>'required',
                'on_time'=>'required',
                'fengniao'=>'required',
                'bao'=>'required',
                'zhun'=>'required',
                'start_send'=>'required',
                'send_cost'=>'required',
                'notice'=>'required',
                'discount'=>'required'],
            ['shop_name.required'=>'店铺名称不能为空',
                'shop_img.image'=>'图片格式有错',
                'start_send.required'=>'起送金额不能为空',
                'send_cost.required'=>'配送费不能为空',
                'notice,required'=>'公告不能为空',
                'discount.required'=>'优惠信息不能为空']);
        //获取图片,保存到服务器
        $img = $request->file('img');
        if($img){
            $path = $img->store('public/shop');
        }else{
            $path='';
        }
        //保存数据
        Shop::create(
            ['shop_name'=>$request->shop_name,
                'shop_category_id'=>$request->shop_category_id,
                'shop_img'=>$path,
                'shop_rating'=>4.5,
                'brand'=>$request->brand,
                'on_time'=>$request->on_time,
                'fengniao'=>$request->fengniao,
                'bao'=>$request->bao,
                'piao'=>$request->piao,
                'zhun'=>$request->zhun,
                'start_send'=>$request->start_send,
                'send_cost'=>$request->send_cost,
                'notice'=>$request->notice,
                'discount'=>$request->discount,
                'status'=>1]
        );
        return redirect()->route('shops.index')->with('success','添加商品成功');
    }

    //修改商家信息
    public function edit()
    {
    }

    public function update()
    {
    }

    //查看
    public function show()
    {

    }

    //删除
    public function destroy()
    {
    }
}
