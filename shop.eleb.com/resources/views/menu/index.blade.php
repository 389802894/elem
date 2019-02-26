@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>菜品列表</h4>
            <form  method="get" action="" class="search_form">
                <input type="text" name="keyword" placeholder="请输入要搜索的关键词"/>
                <input type="submit" value="搜索"/>
            </form>
            <table class="news_list">
                <thead>
                <tr>
                    <th>菜品ID</th>
                    <th>菜品名称</th>
                    <th>评分</th>
                    <th>所属商家ID</th>
                    <th>所属分类ID</th>
                    <th>价格</th>
                    <th>描述</th>
                    <th>月销量</th>
                    <th>评分数量</th>
                    <th>提示信息</th>
                    <th>满意度数量</th>
                    <th>满意度评分</th>
                    <th>菜品图片</th>
                    <th>是否上架</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($menus as $menu)
                    <tr>
                        <td>{{$menu->id}}</td>
                        <td>{{$menu->goods_name}}</td>
                        <td>{{$menu->rating}}</td>
                        <td>{{$menu->shop_id}}</td>
                        <td>{{$menu->category_id}}</td>
                        <td>{{$menu->goods_price}}</td>
                        <td>{{$menu->description}}</td>
                        <td>{{$menu->month_sales}}</td>
                        <td>{{$menu->rating_count}}</td>
                        <td>{{$menu->tips}}</td>
                        <td>{{$menu->satisfy_count}}</td>
                        <td>{{$menu->satisfy_rate}}</td>
                        <td>
                            @if($menu->goods_img)
                            <img style="width: 100px;height: 70px;" src="{{$menu->goods_img}}">
                                @else
                                无图
                                @endif
                        </td>
                        <td>{{$menu->status==1?'是':'否'}}</td>
                        <td>
                            <a  href="{{route('menus.edit',[$menu])}}">修改</a> /
                            <form style="display: inline" method="post" action="{{route('menus.destroy',[$menu])}}">
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