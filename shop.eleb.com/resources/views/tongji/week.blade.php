@extends('layout.app')
@section('contents')
    <div class="mainbox">
        <div class="note">
            <h1>最近一周订单统计......</h1>
            <table class="news_list">
                <tr>
                    @foreach($weeks as $date => $week)
                        <th>{{$date}}</th>
                    @endforeach
                </tr>
                <tr>
                    @foreach($weeks as $date => $week)
                        <td>{{$week}}</td>
                    @endforeach
                </tr>
            </table>
            <script src="https://cdn.bootcss.com/echarts/4.1.0-release/echarts.min.js"></script>
            <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
            <div id="main" style="width: 1000px;height:400px;"></div>
            <script type="text/javascript">
                // 基于准备好的dom，初始化echarts实例
                var myChart = echarts.init(document.getElementById('main'));

                // 指定图表的配置项和数据
                var option = {
                    title: {
                        text: '最近一周订单统计'
                    },
                    tooltip: {},
                    legend: {
                        data: ['订单量']
                    },
                    xAxis: {
//            data: ["衬衫", "羊毛衫", "雪纺衫", "裤子", "高跟鞋", "袜子"]
                        data: {!! json_encode(array_keys($weeks)) !!}
                    },
                    yAxis: {},
                    series: [{
                        name: '订单量',
                        type: 'bar',
//                        data: [5, 20, 36, 10, 10, 20]
                        data: {!! json_encode(array_values($weeks)) !!}
                    }]
                };

                // 使用刚指定的配置项和数据显示图表。
                myChart.setOption(option);
            </script>
        </div>
    </div>
@stop