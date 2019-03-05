@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h3>订单详情......</h3>
            <form method="get" action="" class="search_form">
                <input type="text" name="keyword" placeholder="请输入要搜索的关键词"/>
                <input type="submit" value="搜索"/>
            </form>
            <table class="news_list">
                <thead>
                <tr>
                    <th>订单用户:</th>
                    <th>订单编号:</th>
                    <th>配送地址:</th>
                    <th>配送电话:</th>
                    <th>总价:</th>
                    <th>创建时间:</th>
                </tr>
                <tr>
                    <td>{{$order->name}}</td>
                    <td>{{$order->sn}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->tel}}</td>
                    <td>{{$order->total}}</td>
                    <td>{{$order->order_birth_time}}</td>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@stop