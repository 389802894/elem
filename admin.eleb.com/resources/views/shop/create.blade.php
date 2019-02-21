@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>添加分类</h4>
            @include('layout._error')
            <form action="{{route('shops.store')}}" method="post" enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td>店铺分类：</td>
                        <td><select class="inbox" name="shop_category_id">
                                @foreach($shopCategories as $shopCategory)
                                <option value="{{$shopCategory->id}}">{{$shopCategory->name}}</option>
                                    @endforeach
                            </select>

                        </td>
                    </tr>
                    <tr>
                        <td>店铺名称：</td>
                        <td><input type="text" name="shop_name" class="inbox" value="{{old('shop_name')}}"/></td>
                    </tr>
                    <tr>
                        <td>店铺图片：</td>
                        <td><input  type="file" name="shop_img" class="inbox"/></td>
                    </tr>
                    <tr>
                        <td>是否为品牌：</td>
                        <td>
                            <label><input name="brand" type="radio" value="1" />是 </label>
                            <label><input name="brand" type="radio" value="0" />否 </label>
                        </td>
                    </tr>
                    <tr>
                        <td>是否准时送达：</td>
                        <td>
                            <label><input name="on_time" type="radio" value="1" />是 </label>
                            <label><input name="on_time" type="radio" value="0" />否 </label>
                        </td>
                    </tr>
                    <tr>
                        <td>是否为蜂鸟配送：</td>
                        <td>
                            <label><input name="fengniao" type="radio" value="1" />是 </label>
                            <label><input name="fengniao" type="radio" value="0" />否 </label>
                        </td>
                    </tr>
                    <tr>
                        <td>是否保标记：</td>
                        <td>
                            <label><input name="bao" type="radio" value="1" />是 </label>
                            <label><input name="bao" type="radio" value="0" />否 </label>
                        </td>
                    </tr>
                    <tr>
                        <td>是否票标记：</td>
                        <td>
                            <label><input name="piao" type="radio" value="1" />是 </label>
                            <label><input name="piao" type="radio" value="0" />否 </label>
                        </td>
                    </tr>
                    <tr>
                        <td>是否准标记：</td>
                        <td>
                            <label><input name="zhun" type="radio" value="1" />是 </label>
                            <label><input name="zhun" type="radio" value="0" />否 </label>
                        </td>
                    </tr>
                    <tr>
                        <td>起送金额：</td>
                        <td><input type="text" name="start_send" class="inbox" value="{{old('start_send')}}"/></td>
                    </tr>
                    <tr>
                        <td>配送费：</td>
                        <td><input type="text" name="send_cost" class="inbox" value="{{old('send_cost')}}"/></td>
                    </tr>
                    <tr>
                        <td>店公告：</td>
                        <td><input type="text" name="notice" class="inbox" value="{{old('notice')}}"/></td>
                    </tr>
                    <tr>
                        <td>优惠信息：</td>
                        <td><input type="text" name="discount" class="inbox" value="{{old('discount')}}"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="提交"/></td>
                    </tr>
                </table>
                {{csrf_field()}}
            </form>
        </div>
    </div>
    @stop