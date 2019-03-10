@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>菜单列表</h4>
            <form method="get" action="{{route('navs.index')}}" class="search_form">
                <input type="text" name="keyword" placeholder="请输入要搜索的关键词"/>
                <input type="submit" value="搜索"/>
            </form>
            <table class="news_list">
                <thead>
                <tr>
                    <th>导航ID</th>
                    <th>导航名称</th>
                    <th>URL</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($navs as $nav)
                    <tr>
                        <td>{{$nav->id}}</td>
                        <td>{{$nav->name}}</td>
                        <td>{{$nav->url}}</td>
                        <td>
                            <a href="{{route('navs.edit',[$nav])}}">修改</a> /
                            <form style="display: inline" method="post" action="">
                                <button type="submit" class="btn btn-danger">删除</button>
                                {{csrf_field()}}
                                {{method_field('delete')}}
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$navs->appends(['keyword'=>$keyword])->links()}}
        </div>
    </div>
@stop