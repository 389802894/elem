@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h3>活动详情......</h3>
            <table class="news_list">
                <thead>
                <tr>
                    <th>活动详情:</th>
                </tr>
                <tr><td>{{$activity->content}}</td></tr>
                </thead>
            </table>
        </div>
    </div>
@stop