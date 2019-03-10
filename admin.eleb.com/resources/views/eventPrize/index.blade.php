@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>奖品列表......</h4>
            <table class="news_list">
                <thead>
                <tr>
                    <th>奖品ID</th>
                    <th>活动id</th>
                    <th>奖品名称</th>
                    <th>奖品详情</th>
                    <th>中奖商家账户id</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($event_prizes as $event_prize)
                    <tr>
                        <td>{{$event_prize->id}}</td>
                        <td>{{$event_prize->events_id}}</td>
                        <td>{{$event_prize->name}}</td>
                        <td>{{$event_prize->description}}</td>
                        <td>{{$event_prize->member_id}}</td>
                        <td>
                            <a href="{{route('event_prizes.edit',[$event_prize])}}">修改</a> /
                            <form style="display: inline" method="post" action="{{route('event_prizes.destroy',[$event_prize])}}">
                                <button type="submit" class="btn btn-danger">删除</button>
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