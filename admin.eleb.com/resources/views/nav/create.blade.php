@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>添加导航菜单...</h4>
            @include('layout._error')
            <form action="{{route('navs.store')}}" method="post" enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td>导航菜单名称：</td>
                        <td><input type="text" name="name" class="inbox" value="{{old('name')}}"/></td>
                    </tr>
                    <tr>
                        <td>上级导航菜单：</td>
                        <td>
                            <select class="inbox" name="pid">
                                <option value="0">=请选择上级菜单=</option>
                                @foreach($navs as $nav)
                                    <option value="{{$nav->id}}">{{$nav->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>地址/路由：</td>
                        <td><input type="text" name="url" class="inbox" value="{{old('url')}}"/></td>
                    </tr>
                    <tr>
                        <td>菜单权限：</td>
                        <td>
                            @foreach($permissions as $permission)
                                <label>
                                    <input type="radio" name="permission"
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
            </form>
        </div>
    </div>
@stop