@extends('layout.app')
@section('contents')

    <div class="mainbox">
        <div class="note">
            <h4>添加抽奖活动...</h4>
            @include('layout._error')
            @include('vendor.ueditor.assets')
            <form action="{{route('events.store')}}" method="post" enctype="multipart/form-data">
                <table class="news_form">
                    <tr>
                        <td>活动名称：</td>
                        <td><input type="text" name="title" class="inbox" value="{{old('title')}}"/></td>
                    </tr>
                    <tr>
                        <td>活动详情：</td>

                        <td style="width: 900px;">
                            <!-- 实例化编辑器 -->
                            <script type="text/javascript">
                                var ue = UE.getEditor('container');
                                ue.ready(function () {
                                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                                });
                            </script>

                            <!-- 编辑器容器 -->
                            <script id="container" name="content" type="text/plain"></script>
                        </td>
                    </tr>
                    <tr>
                        <td>包名开始时间：</td>
                        <td><input type="date" name="signup_start" class="inbox" value="{{old('signup_start')}}"/></td>
                    </tr>
                    <tr>
                        <td>报名结束时间：</td>
                        <td><input type="date" name="signup_end" class="inbox" value="{{old('signup_end')}}"/></td>
                    </tr>
                    <tr>
                        <td>开奖日期：</td>
                        <td><input type="date" name="prize_date" class="inbox" value="{{old('prize_date')}}"/></td>
                    </tr>
                    <tr>
                        <td>报名人数限制：</td>
                        <td><input type="text" name="signup_num" class="inbox" value="{{old('signup_num')}}"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="添加"/></td>
                    </tr>
                </table>
                {{csrf_field()}}
            </form>
        </div>
    </div>
@stop