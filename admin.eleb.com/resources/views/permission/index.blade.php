@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>权限列表</h4>
            <form method="get" action="" class="search_form">
                <input type="text" name="keyword" placeholder="请输入要搜索的关键词"/>
                <input type="submit" value="搜索"/>
            </form>
            <table class="news_list">
                <thead>
                <tr>
                    <th>权限ID</th>
                    <th>权限名称</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                <tr>
                    <td>{{$permission->id}}</td>
                    <td>{{$permission->name}}</td>
                    <td>
                        <a href="{{route('permissions.edit',[$permission])}}">修改</a> /
                        <form style="display: inline" method="post" action="{{route('permissions.destroy',[$permission])}}">
                            <button type="submit" class="btn btn-danger">删除</button>
                            {{csrf_field()}}
                            {{method_field('delete')}}
                        </form>
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
            {{$permissions->appends(['keyword'=>$keyword])->links()}}
        </div>
    </div>
@stop