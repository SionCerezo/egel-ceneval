$(function () {
    // ==============================================================
    // Postulations Chart
    // ==============================================================

    var chart1 = c3.generate({
        bindto: '#posts-chart',
        data: {
            columns: postsDataChart,

            type: 'donut',
            tooltip: {
                show: true
            }
        },
        donut: {
            label: {
                show: false
            },
            title: 'Postulaciones',
            width: 18
        },

        legend: {
            hide: true
        },
        color: {
            pattern: statusColors
        }
    });

    d3.select('#posts-chart .c3-chart-arcs-title').style('font-family', 'Rubik');
})
