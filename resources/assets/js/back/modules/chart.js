/* ---------- Charts.js */

var Chart = require('chart.js');

// chartData is defined in the view
$(function () {
    let chartData = global.chartData;

    if (chartData) {
        new Chart(chartData.ctx).Line(chartData.chart, {
            bezierCurve: false,
            responsive: true,
            scaleShowVerticalLines: false,
            scaleFontFamily: 'Lato, sans-serif',
            scaleFontColor: '#9699a1',
        });


        //ADDON for legend
        let $legend = $('#' + chartData.graphName + '-legend');
        if ($legend.length) {
            $(chartData.chart.datasets).each(function () {
                var $legendLine = $('<div></div>').addClass('chart_legend_item');
                var $bullet = $('<span></span>').css('background', this.fillColor).addClass('chart_legend_bullet');
                var $label = $('<span></pan>').text(this.label).addClass('chart_legend_description');
                $bullet.appendTo($legendLine);
                $label.appendTo($legendLine);
                $legendLine.appendTo($legend);
            });
        }
    }
});
