@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>添加分类</h4>
            @include('layout._error')
            <form action="{{route('admins.store')}}" method="post" enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td>管理员名称：</td>
                        <td><input type="text" name="name" class="inbox" value="{{old('name')}}"/></td>
                    </tr>
                    <tr>
                        <td>管理员邮箱：</td>
                        <td><input type="text" name="email" class="inbox" value="{{old('email')}}"/></td>
                    </tr>
                    <tr>
                        <td>密码：</td>
                        <td><input type="password" name="password" class="inbox" value="{{old('password')}}"/></td>
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