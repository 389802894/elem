@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>员工列表</h4>
            <form method="post" action="" class="search_form">
                <input type="text" name="keywords" placeholder="请输入要搜索的关键词"/>
                <input type="submit" value="搜索"/>
            </form>
            <table class="news_list">
                <thead>
                <tr>
                    <th>分类ID</th>
                    <th>分类名称</th>
                    <th>分类图片</th>
                    <th>状态</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($shop_categories as $shop_category)
                <tr>
                    <td>{{$shop_category->id}}</td>
                    <td>{{$shop_category->name}}</td>
                    <td>{{$shop_category->img}}</td>
                    <td>{{$shop_category->status}}</td>
                    <td>{{$shop_category->created_at}}</td>
                    <td>
                        <a href="">修改</a> /
                        <a href="">删除</a>
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @stop