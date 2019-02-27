<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BusinessController extends Controller
{
    //商家列表
    public function businessList(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {
            $shops = Shop::where('shop_name', 'like', "%$keyword%")->get();
        } else {
            $shops = Shop::all();
        }
        return $shops;
    }

    //z指定商家
    public function business(Request $request)
    {
        $id = $request->id;
        $shop = Shop::find($id);
        $menu_categories = MenuCategory::where('shop_id', '=', $id)->get();

        foreach ($menu_categories as $menu_category) {
            $menu_category['goods_list'] = Menu::where('category_id', '=', $menu_category->id)->get();
        }
        $shop['commodity'] = $menu_categories;
        return $shop;
    }

    //用户注册
    public function register(Request $request)
    {
        $this->validate($request,
            ['username' => 'required',
                'password' => 'required',
                'tel' => 'required']);
        Member::create(['username' => $request->username, 'password' => $request->password, 'tel' => $request->tel]);
        return ['status' => true, 'message' => '注册成功'];
    }

    //用户登录
    public function login(Request $request)
    {
        $this->validate($request, ['username' => 'required', 'password' => 'required']);
        if (Auth::attempt(
            ['username' => $request->username, 'password' => $request->password],
            $request->has('rememberMe')
        )
        ) {
            return ['status' => true, 'message' => '登录成功',
                'user_id' => auth()->user()->id, 'username' => auth()->user()->username];
        }
        return ['status' => false, 'message' => '账号或密码错误'];
    }
}
