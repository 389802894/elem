<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function __construct()
    {
        //制定当前控制器使用的中间件
        // auth表示必须通过登录认证
        $this->middleware('auth'
            //配置  只对哪些方法生效
            //'only'=>[],
            //不对哪些方法生效

        );
    }

    //菜品列表
    public function index()
    {
        $menus = Menu::all();
        return view('menu.index',compact('menus'));
    }

    //添加菜品
    public function create()
    {
        $shopUsers = ShopUser::all();
        $menuCategories = MenuCategory::all();
        return view('menu.create',compact('shopUsers','menuCategories'));

    }

    public function store(Request $request)
    {
        $this->validate($request,
            ['goods_name'=>'required',
                'rating'=>'required',
                'goods_price'=>'required',
                'description'=>'required',
                'month_sales'=>'required',
                'rating_count'=>'required',
                'tips'=>'required',
                'satisfy_count'=>'required',
                'status'=>'required']
            );
        //判断是否上传图片
        $img = $request->file('goods_img');
        if ($img){
            $path = url(Storage::url($img->store('public/menu')));
        }else{
            $path='';
        }
        $menu = new Menu();
        $menu->goods_name=$request->goods_name;
        $menu->rating=$request->rating;
        $menu->shop_id=$request->shop_id;
        $menu->category_id=$request->category_id;
        $menu->description=$request->description;
        $menu->month_sales=$request->month_sales;
        $menu->goods_price=$request->goods_price;
        $menu->rating_count=$request->rating_count;
        $menu->tips=$request->tips;
        $menu->satisfy_count=$request->satisfy_count;
        $menu->satisfy_rate=9.8;
        $menu->goods_img=$path;
        $menu->status=$request->status;
        $menu->save();

        return redirect()->route('menus.index')->with('success','添加菜品成功');


    }

    //修改菜品
    public function edit(Menu $menu)
    {
        $shopUsers = ShopUser::all();
        $menuCategories = MenuCategory::all();
        return view('menu.edit',compact('menu','shopUsers','menuCategories'));
    }

    public function update(Request $request,Menu $menu)
    {
//        dd($menu->goods_img);
        $this->validate($request,
            ['goods_name'=>'required',
                'rating'=>'required',
                'goods_price'=>'required',
                'description'=>'required',
                'month_sales'=>'required',
                'rating_count'=>'required',
                'tips'=>'required',
                'satisfy_count'=>'required',
                'status'=>'required']
        );
        //判断是否上传图片
        $img = $request->file('goods_img');
        if ($img){
            $path = url(Storage::url($img->store('public/menu')));
            $menu->goods_img=$path;
        }
        $menu->goods_name=$request->goods_name;
        $menu->rating=$request->rating;
        $menu->shop_id=$request->shop_id;
        $menu->category_id=$request->category_id;
        $menu->description=$request->description;
        $menu->month_sales=$request->month_sales;
        $menu->goods_price=$request->goods_price;
        $menu->rating_count=$request->rating_count;
        $menu->tips=$request->tips;
        $menu->satisfy_count=$request->satisfy_count;
        $menu->satisfy_rate=9.8;
        $menu->status=$request->status;
        $menu->save();

        return redirect()->route('menus.index')->with('success','修改菜品成功');

    }

    //删除菜品
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success','删除成功');
    }
}
