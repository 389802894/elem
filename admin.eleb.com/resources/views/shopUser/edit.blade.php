@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>修改商家账户</h4>
            @include('layout._error')
            <form action="{{route('shopUsers.update',[$shopUser])}}" method="post" enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td>账户名称：</td>
                        <td><input type="text" name="name" class="inbox" value="{{$shopUser->name}}"/></td>
                    </tr>
                    <tr>
                        <td>账户邮箱：</td>
                        <td><input type="text" name="email" class="inbox" value="{{$shopUser->email}}"/></td>
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