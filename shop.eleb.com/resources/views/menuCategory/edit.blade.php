@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>修改菜品分类...</h4>
            @include('layout._error')
            <form action="{{route('menuCategories.update',[$menuCategory])}}" method="post" enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td>分类名称：</td>
                        <td><input type="text" name="name" class="inbox" value="{{$menuCategory->name}}"/></td>
                    </tr>
                    <tr>
                        <td>所属商家：</td>
                        <td><select class="inbox" name="shop_id">
                                @foreach($shopUsers as $shopUser)
                                    <option
                                            @if($shopUser->id==$menuCategory->shop_id)
                                                    selected
                                            @endif
                                            value="{{$shopUser->id}}">{{$shopUser->name}}</option>
                                @endforeach
                            </select>

                        </td>
                    </tr>
                    <tr>
                        <td>描述：</td>
                        <td><input type="text" name="description" class="inbox" value="{{$menuCategory->description}}"> </td>
                    </tr>
                    <tr>
                        <td>是否为默认分类：</td>
                        <td>
                            <label><input @if($menuCategory->is_selected==1) checked @endif name="is_selected" type="radio" value="1" />是 </label>
                            <label><input <input @if($menuCategory->is_selected==0) checked @endif name="is_selected" type="radio" value="0" />否 </label>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="确定修改"/></td>
                    </tr>
                </table>
                {{csrf_field()}}
                {{method_field('patch')}}
            </form>
        </div>
    </div>
@stop