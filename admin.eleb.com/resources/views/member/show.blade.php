@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h3>会员详情......</h3>
            <form method="get" action="" class="search_form">
                <input type="text" name="keyword" placeholder="请输入要搜索的关键词"/>
                <input type="submit" value="搜索"/>
            </form>
            <table class="news_list">
                <thead>
                <tr>
                    <th>会员id:</th>
                    <th>会员名:</th>
                    <th>电话:</th>
                    <th>创建时间:</th>
                </tr>
                <tr>
                    <td>{{$member->id}}</td>
                    <td>{{$member->username}}</td>
                    <td>{{$member->tel}}</td>
                    <td>{{$member->created_at}}</td>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@stop