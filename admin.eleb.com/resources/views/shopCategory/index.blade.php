@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>分类列表</h4>
            <form  method="get" action="{{route('shopCategories.index')}}" class="search_form">
                <input type="text" name="keyword" placeholder="请输入要搜索的关键词"/>
                <input type="submit" value="搜索"/>
            </form>
            <table class="news_list">
                <thead>
                <tr>
                    <th>分类ID</th>
                    <th>头像</th>
                    <th>分类名</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($shopCategories as $shopCategory)
                    <tr>
                        <td>{{$shopCategory->id}}</td>
                        @if($shopCategory->img)
                        <td><img style="width: 100px; height: 70px" src="{{$shopCategory->img}}"> </td>
                        @else
                            <td>无图</td>
                        @endif
                        <td>{{$shopCategory->name}}</td>
                        <td>{{$shopCategory->created_at}}</td>
                        <td>
                            <a  href="{{route('shopCategories.edit',[$shopCategory])}}">修改</a> /
                            <form style="display: inline" method="post" action="{{route('shopCategories.destroy',[$shopCategory])}}">
                                <button type="submit" class="btn btn-danger"  >删除</button>
                                {{csrf_field()}}
                                {{method_field('delete')}}
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$shopCategories->appends(['keyword'=>$keyword])->links()}}
        </div>
    </div>
@stop