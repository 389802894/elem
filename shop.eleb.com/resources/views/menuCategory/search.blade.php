@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>管理员列表</h4>
            <form  method="get" action="{{route('search')}}" class="search_form">
                <input type="text" name="keyword" placeholder="请输入要搜索的关键词"/>
                <input type="submit" value="搜索"/>
            </form>
            <table class="news_list">
                <thead>
                <tr>
                    <th>菜品ID</th>
                    <th>菜品名称</th>
                    <th>菜品价格</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rs as $r)
                    <tr>
                        <td>{{$r->id}}</td>
                        <td>{{$r->goods_name}}</td>
                        <td>{{$r->goods_price}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop