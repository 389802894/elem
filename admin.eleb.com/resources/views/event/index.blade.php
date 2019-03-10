@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>抽奖活动列表......</h4>
            <table class="news_list">
                <thead>
                <tr>
                    <th>活动ID</th>
                    <th>标题</th>
                    <th>内容</th>
                    <th>报名开始时间</th>
                    <th>报名结束时间</th>
                    <th>开奖日期</th>
                    <th>报名人数限制</th>
                    <th>是否开奖</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{$event->id}}</td>
                        <td>{{$event->title}}</td>
                        <td>{!! $event->content !!}</td>
                        <td>{{date('Y-m-d',$event->start_time)}}</td>
                        <td>{{date('Y-m-d',$event->end_time)}}</td>
                        <td>{{$event->prize_date}}</td>
                        <td>{{$event->signup_num}}</td>
                        <td>{{$event->is_prize?'是':'否'}}</td>
                        <td>
                            @if($event->is_prize == 0)
                            <form style="display: inline" method="post" action="{{route('events.destroy',[$event])}}">
                                <button type="submit" class="btn btn-danger">开奖</button>
                                {{csrf_field()}}
                                {{method_field('delete')}}
                            </form>
                                @else
                                已开奖
                                @endif()
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop