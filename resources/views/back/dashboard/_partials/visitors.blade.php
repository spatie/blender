<h2>Visitors</h2>

<blender-chart class="chart">
    <canvas id="daily-visitors" width=1000 height=250></canvas>
    <div class="chart__legend" id="daily-visitors-legend"></div>
</blender-chart>

<script>
    window.chartData = {
            graphName : 'daily-visitors',
            ctx : document.getElementById('daily-visitors').getContext('2d'),
            chart : {
                labels: @json($dates->map->format('d/m')),
                datasets: [
                    {
                        label: 'Visitors',
                        data: @json($visitors),
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                    },
                    {
                        label: 'Views',
                        data: @json($pageViews),
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
