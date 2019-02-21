@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h4>分类列表</h4>
            <form  method="get" action="{{route('shops.index')}}" class="search_form">
                <input type="text" name="keyword" placeholder="请输入要搜索的关键词"/>
                <input type="submit" value="搜索"/>
            </form>
            <table class="news_list">
                <thead>
                <tr>
                    <th>商家ID</th>
                    <th>商家分类</th>
                    <th>商家名称</th>
                    <th>商家图片</th>
                    <th>评分</th>
                    <th>起送金额</th>
                    <th>配送费</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($shops as $shop)
                    <tr>
                        <td>{{$shop->id}}</td>
                        <td>{{$shop->shop_category_id}}</td>
                        <td>{{$shop->shop_name}}</td>
                        @if($shop->shop_img)
                            <td><img style="width: 100px; height: 70px" src="{{\Illuminate\Support\Facades\Storage::url($shop->shop_img)}}"> </td>
                        @else
                            <td>无图</td>
                        @endif
                        <td>{{$shop->shop_rating	}}</td>
                        <td>{{$shop->start_send}}</td>
                        <td>{{$shop->send_cost}}</td>
                        <td>
                            <a  href="{{route('shops.edit',[$shop])}}">修改</a> /
                            <form style="display: inline" method="post" action="{{route('shops.destroy',[$shop])}}">
                                <button type="submit" class="btn btn-danger"  >删除</button>
                                {{csrf_field()}}
                                {{method_field('delete')}}
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$shops->appends(['keyword'=>$keyword])->links()}}

        </div>
    </div>
@stop