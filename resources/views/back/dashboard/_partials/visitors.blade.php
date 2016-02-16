<h2>{{ fragment('back.statistics.visitors') }}</h2>

<div class="chart" data-chart>
    <canvas id="daily-visitors" width=1000 height=250></canvas>
    <div class="chart_legend" id="daily-visitors-legend">
    </div>
</div>


{{-- {!! link_to_action('StatisticsController@index', 'Bekijk meer statistieken', null ) !!} --}}

@section('extraJs')
@parent
<script>
    var chartData = {
            graphName : 'daily-visitors',
            ctx : document.getElementById('daily-visitors').getContext('2d'),
            chart : {
                labels: {!! json_encode(array_map(function($date) {return $date->format('d/m');}, $dates)) !!},
                datasets: [
                    {
                        label: '{{ fragment('back.statistics.visitors') }}',
                        data: {!! json_encode($visitors) !!},
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                    },
                    {
                        label: 'Pageviews',
                        data: {!! json_encode($pageViews) !!},
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                    }
                ]
            }
    };
</script>
@stop
