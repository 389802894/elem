<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//菜品分类控制器
class MenuCategoryController extends Controller
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
    //菜品分类列表
    public function index()
    {
        $menuCategories = MenuCategory::all();
        return view('menuCategory.index', compact('menuCategories'));
    }

    //添加菜品分类
    public function create()
    {
        $shopUsers = ShopUser::all();
        return view('menuCategory.create', compact('shopUsers'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            ['name' => 'required',
                'description' => 'required',
                'is_selected' => 'required']);
        MenuCategory::create(
            ['name' => $request->name,
                'type_accumulation' => 'a',
                'shop_id' => $request->shop_id,
                'description' => $request->description,
                'is_selected' => $request->is_selected]
        );
        return redirect()->route('menuCategories.index')->with('success', '添加成功');
    }

    //修改菜品分类
    public function edit(MenuCategory $menuCategory)
    {
        $shopUsers = ShopUser::all();
        return view('menuCategory.edit', compact('menuCategory', 'shopUsers'));
    }

    public function update(Request $request, MenuCategory $menuCategory)
    {
        $this->validate($request,
            ['name' => 'required',
                'description' => 'required',
                'is_selected' => 'required']);
        $menuCategory->update(
            ['name' => $request->name,
                'type_accumulation' => 'a',
                'shop_id' => $request->shop_id,
                'description' => $request->description,
                'is_selected' => $request->is_selected]
        );
        return redirect()->route('menuCategories.index')->with('success', '修改成功');

    }

    //删除分类
    public function destroy(MenuCategory $menuCategory)
    {
        $menus = Menu::all();
        foreach ($menus as $menu) {
//            dd($menu->id);
            if ($menuCategory->id != $menu->category_id) {
                $menuCategory->delete();
                return redirect()->route('menuCategories.index')->with('success', '删除成功');
            } else {
                echo "<script>alert('本分类下有菜品,不能删除');location.href='/menuCategories';</script>";
            }
        }
    }

    //查看该分类下的所有菜品
    public function show(Request $request,MenuCategory $menuCategory)
    {
        $keyword = $request->keyword;
        $menus = Menu::all();

        $rs = DB::select("select * from menus where category_id = :id ", ['id' => $menuCategory->id]);

        return view('menuCategory.show', compact('rs'));
    }

//    //搜索
//    public function search(Request $request)
//    {
//        $keyword = $request->keyword;
//        if($keyword){
//            $rs = DB::select("select * from menus where category_id = :id and (goods_name like '%$keyword%') ", ['id' => $menuCategory->id]);
//        }
//    }
}
