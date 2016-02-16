<h2>{{ fragment('back.statistics.visitors') }}</h2>
<div class="chart" data-chart>
    <canvas id="visitors" width=1000 height=250></canvas>
    <div class="chart_legend" id="visitors-legend">
    </div>
</div>

@section('extraJs')
    @parent
    <script>
        var chartData = {
            graphName : 'visitors',
            ctx : document.getElementById('visitors').getContext('2d'),
            chart : {
                labels: {!! json_encode(array_map(function($month) {return $month->format('m-Y');}, $visitorsData->lists('yearMonth')->toArray())) !!},
                datasets: [
                    {
                        label: '{{ fragment('back.statistics.visitors') }}',
                        data: {!! json_encode($visitorsData->lists('visitors')) !!},
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                    },
                    {
                        label: 'Pageviews',
                        data: {!! json_encode($visitorsData->lists('pageViews')) !!},
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                    },
                ],
            }
        };
    </script>
@stop
