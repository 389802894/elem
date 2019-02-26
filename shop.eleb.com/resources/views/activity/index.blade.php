@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>活动列表</h4>
            <form  method="get" action="" class="search_form">
                <input type="text" name="keyword" placeholder="请输入要搜索的关键词"/>
                <input type="submit" value="搜索"/>
            </form>
            <table class="news_list">
                <thead>
                <tr>
                    <th>活动ID</th>
                    <th>活动名称</th>
                    <th>开始时间</th>
                    <th>结束时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($activities as $activity)
                    <tr>
                        <td>{{$activity->id}}</td>
                        <td>{{$activity->title}}</td>
                        <td>{{date('Y-m-d',$activity->start_time)}}</td>
                        <td>{{date('Y-m-d',$activity->end_time)}}</td>
                        <td>
                            <a  href="{{route('activities.show',[$activity])}}">查看详情</a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop