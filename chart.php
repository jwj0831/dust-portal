<?php
include ("header.php");
?>
			<div id="chart_area" style="width:100%; height:400px;"></div>
			<script type="text/javascript">
var chart; // global

/**
 * Request data from the server, add it to the graph and set a timeout 
 * to request again
 */
function requestData() {
	jQuery.ajax({
	    url: 'chart-data.php',
	    success: function(point) {
	    	var series = chart.series[0];
	        var shift = series.data.length > 20; // shift if the series is longer than 20
	        var series = chart.series[1];
	        var shift = series.data.length > 20; // shift if the series is longer than 20
		
	        // add the point
	        chart.series[0].addPoint(point[1], true, shift);
	        chart.series[1].addPoint(point[2], true, shift);
	        // call it again after one second
	        setTimeout(requestData, 30000);    
	    },
	    cache: false
	});
}

jQuery(document).ready(function() {
	/*
	Highcharts.setOptions({
		global: {
			useUTC: false
		}
	});
	*/
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'chart_area',
            events: {
                load: requestData
            }
        },
        title: {
            text: 'Real-time Indoor Dust Monitoring Chart'
        },
        xAxis: {
            type: 'datetime',
           	tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: [{ // Primary yAxis
            labels: {
                formatter: function() {
                    return this.value +'pcs/283mL';
                },
                style: {
                    color: '#4572A7'
                }
            },
            title: {
                text: 'Concentration (pcs/283mL)',
                style: {
                    color: '#4572A7'
                }
            },
        }, { // Secondary yAxis
            title: {
                text: 'IDI',
                style: {
                    color: '#C94D4D'
                }
            },
            labels: {
                style: {
                    color: '#C94D4D'
                }
            },
			min: -1,
			max: 3,
			opposite: true
        }],
        tooltip: {
                shared: true
        },
        series: [{
                name: 'Raw Dust Particles',
                color: '#4572A7',
                type: 'spline',
                data: [],
                tooltip: {
                    valueSuffix: ' pcs/283mL'
                }
    
            }, {
                name: 'IDI',
                color: '#C94D4D',
                type: 'spline',
                data: []
    		}]
    });
});			
			
			</script>
			<div class="footer text-center">
				Copyright at <strong>K2V</strong> in 2013 Fusion Project Class
			</div>
		</div><!-- /.container -->
	</body>
</html>