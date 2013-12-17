<?php
include ("header.php");
?>
			<div id="chart_area" style="width:100%; height:400px;"></div>
			<script type="text/javascript">
			jQuery(function () { 
    			jQuery('#chart_area').highcharts({
			        chart: {
			            type: 'bar'
			        },
			        title: {
			            text: 'Fruit Consumption'
			        },
			        xAxis: {
			            categories: ['Apples', 'Bananas', 'Oranges']
			        },
			        yAxis: {
			            title: {
			                text: 'Fruit eaten'
			            }
			        },
			        series: [{
			            name: 'Jane',
			            data: [1, 0, 4]
			        }, {
			            name: 'John',
			            data: [5, 7, 3]
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