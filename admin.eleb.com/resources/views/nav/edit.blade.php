@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>修改导航菜单...</h4>
            @include('layout._error')
            <form action="{{route('navs.update',[$nav])}}" method="post" enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td>导航菜单名称：</td>
                        <td><input type="text" name="name" class="inbox" value="{{$nav->name}}"/></td>
                    </tr>
                    <tr>
                        <td>上级导航菜单：</td>
                        <td>
                            <select class="inbox" name="pid">
                                <option value="0">=请选择上级菜单=</option>
                                @foreach($navs as $n)
                                    <option
                                            @if($n->id == $nav->pid) selected @endif
                                            value="{{$n->id}}">{{$n->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>地址/路由：</td>
                        <td><input type="text" name="url" class="inbox" value="{{$nav->url}}"/></td>
                    </tr>
                    <tr>
                        <td>菜单权限：</td>
                        <td>
                            @foreach($permissions as $permission)
                                <label>
                                    <input type="radio" name="permission"
                                           {{$nav->permission_id==$permission->id?'checked':''}}
                                           value="{{$permission->id}}">{{$permission->name}}
                                </label>
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