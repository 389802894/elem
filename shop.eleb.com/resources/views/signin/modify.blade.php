@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4></h4>
            @include('layout._error')
            <form action="{{route('update')}}" method="post" enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td>请输入原密码：</td>
                        <td><input type="password" name="old_password" class="inbox" value=""/></td>
                    </tr>
                    <tr>
                        <td>请输入新密码：</td>
                        <td><input type="password" name="new_password1" class="inbox" value=""/></td>
                    </tr>
                    <tr>
                        <td>请确认密码：</td>
                        <td><input type="password" name="new_password" class="inbox" value=""/></td>
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
