<h2>Visitors</h2>

<blender-chart class="chart">
    <canvas id="visitors" width=1000 height=250></canvas>
    <div class="chart__legend" id="visitors-legend"></div>
</blender-chart>

<script>
    window.chartData = {
        graphName: 'visitors',
        ctx: document.getElementById('visitors').getContext('2d'),
        chart: {
            labels: {!! json_encode($visitors->pluck('date')->toArray()) !!},
            datasets: [
                {
                    label: 'Visitors',
                    data: {!! json_encode($visitors->pluck('visitors')->toArray())  !!},
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                },
                {
                    label: 'Pageviews',
                    data: {!! json_encode($visitors->pluck('pageViews')->toArray())  !!},
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
