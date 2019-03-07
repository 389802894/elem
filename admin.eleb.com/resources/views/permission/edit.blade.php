@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>修改权限</h4>
            @include('layout._error')
            <form action="{{route('permissions.update',[$permission])}}" method="post" enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td>权限名称：</td>
                        <td><input type="text" name="name" class="inbox" value="{{$permission->name}}"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="提交"/></td>
                    </tr>
                </table>
                {{csrf_field()}}
                {{method_field('patch')}}
            </form>
        </div>
    </div>
@stop