@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>请登录...</h4>
            @include('layout._error')
            <form action="{{route('login')}}" method="post" enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td>管理员名称：</td>
                        <td><input type="text" name="name" class="inbox" value="{{old('name')}}"/></td>
                    </tr>
                    <tr>
                        <td>密码：</td>
                        <td><input type="password" name="password" class="inbox" value="{{old('password')}}"/></td>
                    </tr>
                    <tr>
                        <td>记住我：</td>
                        <td><input type="checkbox" name="rememberMe" value="1"> 记住我</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="登录"/></td>
                    </tr>
                </table>
                {{csrf_field()}}
            </form>
        </div>
    </div>
@stop