@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>添加活动</h4>
            @include('layout._error')
            @include('vendor.ueditor.assets')
            <form action="{{route('activities.update',[$activity])}}" method="post" enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td>活动名称：</td>
                        <td><input type="text" name="title" class="inbox" value="{{$activity->title}}"/></td>
                    </tr>
                    <tr>
                        <td>活动详情：</td>
                        <td style="width: 800px">
                            <!-- 实例化编辑器 -->
                            <script type="text/javascript">
                                var ue = UE.getEditor('container');
                                ue.ready(function() {
                                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                                });
                            </script>

                            <!-- 编辑器容器 -->
                            <script id="container" name="content" type="text/plain">{!!$activity->content!!}</script>


                        </td>
                    </tr>
                    <tr>
                        <td>活动开始时间：</td>
                        <td><input type="date" name="start_time" class="inbox" value="{{date('Y-m-d',$activity->start_time)}}"/></td>
                    </tr>
                    <tr>
                        <td>活动结束时间：</td>
                        <td><input type="date" name="end_time" class="inbox" value="{{date('Y-m-d',$activity->end_time)}}"/></td>
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