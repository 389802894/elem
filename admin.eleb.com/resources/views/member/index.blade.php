@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>管理员列表</h4>
            <form method="get" action="{{route('members.index')}}" class="search_form">
                <input type="text" name="keyword" placeholder="请输入要搜索的关键词"/>
                <input type="submit" value="搜索"/>
            </form>
            <table class="news_list">
                <thead>
                <tr>
                    <th>会员ID</th>
                    <th>会员名称</th>
                    <th>电话</th>
                    <th>状态</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($members as $member)
                    <tr>
                        <td>{{$member->id}}</td>
                        <td>{{$member->username}}</td>
                        <td>{{$member->tel}}</td>
                        <td>
                            @if($member->status==1)
                                正常
                            @elseif($member->status==0)
                                禁用
                            @endif
                        </td>
                        <td>{{$member->created_at}}</td>
                        <td>
                            <a href="{{route('members.show',[$member])}}">查看</a>
                            @if($member->status==1)
                                <form style="display: inline" method="post"
                                      action="{{route('members.destroy',[$member])}}">
                                    <button type="submit">禁用</button>
                                    {{csrf_field()}}
                                    {{method_field('delete')}}
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop