@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>管理员列表</h4>
            <form  method="get" action="" class="search_form">
                <input type="text" name="keyword" placeholder="请输入要搜索的关键词"/>
                <input type="submit" value="搜索"/>
            </form>
            <table class="news_list">
                <thead>
                <tr>
                    <th>分类ID</th>
                    <th>名称</th>
                    <th>编号</th>
                    <th>所属商家</th>
                    <th>描述</th>
                    <th>是否默认分类</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($menuCategories as $menuCategory)
                    <tr>
                        <td>{{$menuCategory->id}}</td>
                        <td>{{$menuCategory->name}}</td>
                        <td>{{$menuCategory->type_accumulation}}</td>
                        <td>{{$menuCategory->shopUser->name}}</td>
                        <td>{{$menuCategory->description}}</td>
                        <td>{{$menuCategory->is_selected==1?'是':'否'}}</td>
                        <td>
                            <a  href="{{route('menuCategories.show',[$menuCategory])}}">查看菜品</a>/
                            <a  href="{{route('menuCategories.edit',[$menuCategory])}}">修改</a> /
                            <form style="display: inline" method="post" action="{{route('menuCategories.destroy',[$menuCategory])}}">
                                <button type="submit" class="btn btn-danger"  >删除</button>
                                {{csrf_field()}}
                                {{method_field('delete')}}
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop