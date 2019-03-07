@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>角色列表</h4>
            <form method="get" action="{{route('roles.index')}}" class="search_form">
                <input type="text" name="keyword" placeholder="请输入要搜索的关键词"/>
                <input type="submit" value="搜索"/>
            </form>
            <table class="news_list">
                <thead>
                <tr>
                    <th>角色ID</th>
                    <th>角色名称</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td>
                        <a href="{{route('roles.edit',[$role])}}">修改</a> /
                        <form style="display: inline" method="post" action="{{route('roles.destroy',[$role])}}">
                            <button type="submit" class="btn btn-danger">删除</button>
                            {{csrf_field()}}
                            {{method_field('delete')}}
                        </form>
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
            {{$roles->appends(['keyword'=>$keyword])->links()}}
        </div>
    </div>
@stop