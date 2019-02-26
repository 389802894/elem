<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopCategoryController extends Controller
{
    //商品分类首页
    public function index(Request $request)
    {
//        $shopCategories = ShopCategory::all();
        $keyword = $request->keyword;
        if ($keyword) {
            $shopCategories = ShopCategory::where('name', 'like', '%$keyword%')->paginate(5);
        } else {
            $shopCategories = ShopCategory::paginate(5);
        }
        return view('shopCategory.index', compact('shopCategories', 'keyword'));
    }

    //创建分类
    public function create()
    {
        return view('shopCategory.create');
    }

    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,
            ['name' => 'required'],
            ['name.required' => '分类名不能为空',
//                'img.image' => '图片格式错误'
            ]);
//        //获取图片,并保存在服务器
//        $img = $request->file('img');
//        if ($img) {
//            $path = $img->store('public/shopCategory');
//        } else {
//            $path = '';
//        }
        //保存数据到数据库
        ShopCategory::create(['name' => $request->name, 'img' => $request->img, 'status' => 1]);
        return redirect()->route('shopCategories.index')->with('success', '添加分类成功');
    }

    //修改分类
    public function edit(ShopCategory $shopCategory)
    {
        return view('shopCategory.edit', compact('shopCategory'));
    }

    public function update(Request $request, ShopCategory $shopCategory)
    {
        //数据验证
        $this->validate($request,
            ['name' => 'required', 'img' => 'image'],
            ['name.required' => '分类名不能为空',
                'img.image' => '图片格式错误'
            ]);
        //获取图片,并保存在服务器
        $img = $request->file('img');
        if ($img) {
            $path = $img->store('public/shopCategory');
            $shopCategory->img = $path;
        }
        $shopCategory->name = $request->name;
        $shopCategory->save();
        return redirect()->route('shopCategories.index')->with('success', '修改分类成功');
    }

    //删除
    public function destroy(ShopCategory $shopCategory)
    {
        $shopCategory->delete();
        return redirect()->route('shopCategories.index')->with('success', '删除分类成功');
    }

    //接受文件上传
    public function upload(Request $request)
    {
        $img = $request->file('file');
        $path = Storage::url($img->store('public/shopCategory'));
        return ['path'=>$path];
    }
}
