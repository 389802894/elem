@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>添加分类</h4>
            @include('layout._error')
            <form action="{{route('menus.store')}}" method="post" enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td>菜品名称：</td>
                        <td><input type="text" name="goods_name" class="inbox" value="{{old('goods_name')}}"/></td>
                    </tr>
                    <tr>
                        <td>评分：</td>
                        <td><input type="text" name="rating" class="inbox" value="{{old('rating')}}"/></td>
                    </tr>
                    <tr>
                        <td>所属商家ID：</td>
                        <td><select class="inbox" name="shop_id">
                                @foreach($shopUsers as $shopUser)
                                    <option value="{{$shopUser->id}}">{{$shopUser->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>所属分类ID：</td>
                        <td><select class="inbox" name="category_id">
                                @foreach($menuCategories as $menuCategory)
                                    <option value="{{$menuCategory->id}}">{{$menuCategory->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>价格：</td>
                        <td><input  type="text" name="goods_price" class="inbox" value="{{old('goods_price')}}"/></td>
                    </tr>

                    <tr>
                        <td>描述：</td>
                        <td><input type="text" name="description" class="inbox" value="{{old('description')}}"/></td>
                    </tr>
                    <tr>
                        <td>月销量：</td>
                        <td><input type="text" name="month_sales" class="inbox" value="{{old('month_sales')}}"/></td>
                    </tr>
                    <tr>
                        <td>评分数量：</td>
                        <td><input type="text" name="rating_count" class="inbox" value="{{old('rating_count')}}"/></td>
                    </tr>
                    <tr>
                        <td>提示信息：</td>
                        <td><input type="text" name="tips" class="inbox" value="{{old('tips')}}"/></td>
                    </tr>
                    <tr>
                        <td>满意度数量：</td>
                        <td><input type="text" name="satisfy_count" class="inbox" value="{{old('satisfy_count')}}"/></td>
                    </tr>
                    <tr>
                        <td>菜品图片：</td>
                        <td><input type="file" name="goods_img" class="inbox"/></td>
                    </tr>
                    <tr>
                        <td>是否上架：</td>
                        <td>
                            <label><input name="status" type="radio" value="1" />是 </label>
                            <label><input name="status" type="radio" value="0" />否 </label>
                        </td>
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