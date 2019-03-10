@extends('layout.app')
@section('contents')

    <div class="mainbox">
        <div class="note">
            <h4>修改奖品...</h4>
            @include('layout._error')
            <form action="{{route('event_prizes.update',[$eventPrize])}}" method="post" enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td>活动名称：</td>
                        <td>
                            <select class="inbox" name="events_id">
                                @foreach($events as $event)
                                    <option
                                            @if($eventPrize->events_id == $event->id) selected @endif
                                            value="{{$event->id}}">{{$event->title}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>奖品名称：</td>
                        <td><input type="text" name="name" class="inbox" value="{{$eventPrize->name}}"/></td>
                    </tr>
                    <tr>
                        <td>奖品详情：</td>
                        <td><input type="text" name="description" class="inbox" value="{{$eventPrize->description}}"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="修改"/></td>
                    </tr>
                </table>
                {{csrf_field()}}
                {{method_field('patch')}}
            </form>
        </div>
    </div>
@stop