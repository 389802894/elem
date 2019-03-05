@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>订单管理</h4>
            <form method="get" action="" class="search_form">
                <input type="text" name="keyword" placeholder="请输入要搜索的关键词"/>
                <input type="submit" value="搜索"/>
            </form>
            <table class="news_list">
                <thead>
                <tr>
                    <th>订单ID</th>
                    <th>订单用户</th>
                    <th>商家id</th>
                    <th>订单编号</th>
                    <th>订单状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->shop_id}}</td>
                        <td>{{$order->sn}}</td>
                        <td>
                            @if($order->status==-1)
                                已取消
                            @elseif($order->status==0)
                                待支付
                            @elseif($order->status==1)
                                待发货
                            @elseif($order->status==2)
                                待确认
                            @elseif($order->status==3)
                                完成
                            @endif
                        </td>
                        <td>
                            <a href="{{route('orders.show',[$order])}}">查看订单</a>
                            @if($order->status == 1 )
                                <form style="display: inline" method="post"
                                      action="{{route('orders.destroy',[$order])}}">
                                    <button type="submit" class="btn btn-danger">取消订单</button>
                                    {{csrf_field()}}
                                    {{method_field('delete')}}
                                </form>
                            @endif
                            @if($order->status==1)
                                <form style="display: inline" method="post"
                                      action="{{route('orders.update',[$order])}}">
                                    <button type="submit" class="btn btn-danger">发货</button>
                                    {{csrf_field()}}
                                    {{method_field('patch')}}
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