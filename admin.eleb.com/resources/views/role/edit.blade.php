@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>修改角色</h4>
            @include('layout._error')
            <form action="{{route('roles.update',[$role])}}" method="post" enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td>角色名称：</td>
                        <td><input type="text" name="name" class="inbox" value="{{$role->name}}"/></td>
                    </tr>
                    <tr>
                        <td>选择权限</td>
                        <td>
                            @foreach($permissions as $permission)
                                <label><input type="checkbox" name="permission[]"
                                              @if($role->hasPermissionTo($permission->name))
                                              checked
                                              @endif
                                              value="{{$permission->name}}"/>{{$permission->name}}</label>
                            @endforeach
                        </td>
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