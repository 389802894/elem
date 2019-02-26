@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>修改分类</h4>
            @include('layout._error')
            <form action="{{route('shopCategories.update',[$shopCategory])}}" method="post"
                  enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td>分类名：</td>
                        <td><input type="text" name="name" class="inbox" value="{{$shopCategory->name}}"/></td>
                    </tr>
                    <tr>
                        <td>分类图片：</td>
                        @if($shopCategory->img)
                            <td><img style="width: 100px;height: 70px;"
                                     src="{{$shopCategory->img}}"><input
                                        type="file" name="img" class="inbox"/></td>
                        @else
                            <td><input type="file" name="img" class="inbox"/></td>
                        @endif
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