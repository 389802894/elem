@extends('layout.app')
@section('contents')
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploder/webuploader.css">
    <!--引入JS-->
    <script type="text/javascript" src="/webuploder/webuploader.js"></script>
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
                                     src="{{$shopCategory->img}}">
                                <input type="hidden" name="img" id="img_val">
                                <div id="uploader-demo">
                                    <div id="filePicker">选择图片</div>

                                    <img  src="" id="img" />{{--图片回显--}}
                                </div>
                            </td>
                        @else
                            <td>
                                <input type="hidden" name="img" id="img_val">
                                <div id="uploader-demo">
                                    <div id="filePicker">选择图片</div>
                                    <img   src="" id="img" />
                                </div>
                            </td>
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
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
//            swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: '/upload',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            //设置上传请求参数
            formData:{
                _token:'{{ csrf_token() }}'
            }
        });
        //监听上传成功事件
        uploader.on( 'uploadSuccess', function( file,response ) {
            // do some things.
            console.log(response.path);
            //图片回显
            $("#img").attr('src',response.path);
            //图片地址写入隐藏域
            $("#img_val").val(response.path);
        });
    </script>
@stop