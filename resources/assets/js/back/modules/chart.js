/* global $ */

import Chart from 'chart.js';

// chartData is defined in the view

function init() {
    const chartData = global.chartData;

    if (chartData) {
        new Chart(chartData.ctx).Line(chartData.chart, {
            bezierCurve: false,
            responsive: true,
            scaleShowVerticalLines: false,
            scaleFontColor: '#9699a1',
        });

        //ADDON for legend
        const $legend = $('#' + chartData.graphName + '-legend');
        if ($legend.length) {
            $(chartData.chart.datasets).each(function() {
                var $legendLine = $('<div></div>').addClass('chart__legend__item');
                var $bullet = $('<span></span>')
                    .css('background', this.fillColor)
                    .addClass('chart__legend__bullet');
                var $label = $('<span></pan>')
                    .text(this.label)
                    .addClass('chart__legend_description');
                $bullet.appendTo($legendLine);
                $label.appendTo($legendLine);
                $legendLine.appendTo($legend);
            });
        }
    }
}

export default init;
