@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>添加分类</h4>
            @include('layout._error')
            <form action="{{route('shops.update',[$shop])}}" method="post" enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td></td>
                        <td><h2>店铺信息</h2></td>
                    </tr>
                    <tr>
                        <td>店铺分类：</td>
                        <td><select class="inbox" name="shop_category_id">
                                @foreach($shopCategories as $shopCategory)
                                    <option
                                            @if($shop->shop_category_id==$shopCategory->id)
                                                    selected
                                                    @endif
                                            value="{{$shopCategory->id}}">{{$shopCategory->name}}</option>
                                @endforeach
                            </select>

                        </td>
                    </tr>
                    <tr>
                        <td>店铺名称：</td>
                        <td><input type="text" name="shop_name" class="inbox" value="{{$shop->shop_name}}"/></td>
                    </tr>
                    <tr>
                        <td>店铺图片：</td>
                        <td><input  type="file" name="shop_img" class="inbox"/></td>
                    </tr>
                    <tr>
                        <td>是否为品牌：</td>
                        <td>
                            <label><input @if($shop->brand==1) checked @endif name="brand" type="radio" value="1" />是 </label>
                            <label><input @if($shop->brand==0) checked @endif name="brand" type="radio" value="0" />否 </label>
                        </td>
                    </tr>
                    <tr>
                        <td>是否准时送达：</td>
                        <td>
                            <label><input @if($shop->on_time==1) checked @endif name="on_time" type="radio" value="1" />是 </label>
                            <label><input @if($shop->on_time==0) checked @endif name="on_time" type="radio" value="0" />否 </label>
                        </td>
                    </tr>
                    <tr>
                        <td>是否为蜂鸟配送：</td>
                        <td>
                            <label><input @if($shop->fengniao==1) checked @endif name="fengniao" type="radio" value="1" />是 </label>
                            <label><input @if($shop->fengniao==0) checked @endif name="fengniao" type="radio" value="0" />否 </label>
                        </td>
                    </tr>
                    <tr>
                        <td>是否保标记：</td>
                        <td>
                            <label><input @if($shop->bao==1) checked @endif name="bao" type="radio" value="1" />是 </label>
                            <label><input @if($shop->bao==0) checked @endif name="bao" type="radio" value="0" />否 </label>
                        </td>
                    </tr>
                    <tr>
                        <td>是否票标记：</td>
                        <td>
                            <label><input @if($shop->piao==1) checked @endif name="piao" type="radio" value="1" />是 </label>
                            <label><input @if($shop->piao==0) checked @endif name="piao" type="radio" value="0" />否 </label>
                        </td>
                    </tr>
                    <tr>
                        <td>是否准标记：</td>
                        <td>
                            <label><input @if($shop->zhun==1) checked @endif name="zhun" type="radio" value="1" />是 </label>
                            <label><input @if($shop->zhun==0) checked @endif name="zhun" type="radio" value="0" />否 </label>
                        </td>
                    </tr>
                    <tr>
                        <td>起送金额：</td>
                        <td><input type="text" name="start_send" class="inbox" value="{{$shop->start_send}}"/></td>
                    </tr>
                    <tr>
                        <td>配送费：</td>
                        <td><input type="text" name="send_cost" class="inbox" value="{{$shop->send_cost}}"/></td>
                    </tr>
                    <tr>
                        <td>店公告：</td>
                        <td><input type="text" name="notice" class="inbox" value="{{$shop->notice}}"/></td>
                    </tr>
                    <tr>
                        <td>优惠信息：</td>
                        <td><input type="text" name="discount" class="inbox" value="{{$shop->discount}}"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><h2>商家信息</h2></td>
                    </tr>
                    <tr>
                        <td>商家名称：</td>
                        <td><input type="text" name="name" class="inbox" value="{{old('name')}}"/></td>
                    </tr>
                    <tr>
                        <td>商家邮箱：</td>
                        <td><input type="text" name="email" class="inbox" value="{{old('email')}}"/></td>
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