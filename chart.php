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
	
	        // add the point
	        chart.series[0].addPoint(point, true, shift);
	        
	        // call it again after one second
	        setTimeout(requestData, 1000);    
	    },
	    cache: false
	});
}

jQuery(document).ready(function() {
	
	Highcharts.setOptions({
		global: {
			useUTC: false
		}
	});
	
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'chart_area',
            defaultSeriesType: 'spline',
            events: {
                load: requestData
            }
        },
        title: {
            text: 'Live random data'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Value',
                margin: 80
            }
        },
        series: [{
            name: 'Random data',
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