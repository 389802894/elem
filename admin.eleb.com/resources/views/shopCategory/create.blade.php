@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>添加分类</h4>
            <form action="{{route('shopCategories.store')}}" method="post" enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td>分类名称：</td>
                        <td><input type="text" name="name" class="inbox"/></td>
                    </tr>
                    <tr>
                        <td>分类图片：</td>
                        <td><input type="file" name="img" class="inbox"/></td>
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