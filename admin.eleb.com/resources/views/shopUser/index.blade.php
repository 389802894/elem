@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>商家账户列表</h4>
            <form  method="get" action="{{route('shopUsers.index')}}" class="search_form">
                <input type="text" name="keyword" placeholder="请输入要搜索的关键词"/>
                <input type="submit" value="搜索"/>
            </form>
            <table class="news_list">
                <thead>
                <tr>
                    <th>商家账户ID</th>
                    <th>商家账户名称</th>
                    <th>邮箱</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($shopUsers as $shopUser)
                    <tr>
                        <td>{{$shopUser->id}}</td>
                        <td>{{$shopUser->name}}</td>
                        <td>{{$shopUser->email}}</td>
                        <td>{{$shopUser->created_at}}</td>
                        <td>
                            <a  href="{{route('shopUsers.edit',[$shopUser])}}">修改</a> /
                            <form style="display: inline" method="post" action="{{route('shopUsers.reset',[$shopUser])}}">
                                <button type="submit" class="btn btn-danger"  >重置密码</button>
                                {{csrf_field()}}
                                {{method_field('patch')}}
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop