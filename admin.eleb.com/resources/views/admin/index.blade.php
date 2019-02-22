@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>管理员列表</h4>
            <form  method="get" action="{{route('admins.index')}}" class="search_form">
                <input type="text" name="keyword" placeholder="请输入要搜索的关键词"/>
                <input type="submit" value="搜索"/>
            </form>
            <table class="news_list">
                <thead>
                <tr>
                    <th>管理员ID</th>
                    <th>管理员名称</th>
                    <th>邮箱</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
               @foreach($admins as $admin)
                    <tr>
                        <td>{{$admin->id}}</td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->email}}</td>
                        <td>{{$admin->created_at}}</td>
                        <td>
                            <a  href="{{route('admins.edit',[$admin])}}">修改</a> /
                            <form style="display: inline" method="post" action="{{route('admins.destroy',[$admin])}}">
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