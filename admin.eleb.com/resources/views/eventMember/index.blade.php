@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>报名活动人列表......</h4>
            <table class="news_list">
                <thead>
                <tr>
                    <th>活动报名ID</th>
                    <th>报名人</th>
                    <th>活动名</th>
                </tr>
                </thead>
                <tbody>

                @foreach($event_members as $event_member)
                    <tr>
                        <td>{{$event_member->id}}</td>
                        @foreach($shopUsers as $shopUser)
                            @if($shopUser->id == $event_member->member_id)
                                <td>{{$shopUser->name}}</td>
                            @endif
                        @endforeach
                        @foreach($events as $event)
                            @if($event->id == $event_member->events_id)
                                <td>{{ $event->title }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop