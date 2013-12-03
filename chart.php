<?php
include ("header.php");
?>
			<script>
				google.load(“visualization”, “1″, {packages:["corechart"]});
				google.setOnLoadCallback(drawChart);
				function drawChart() {
						var jsonData = $.ajax({
						url: “chart_process.php”,
						dataType:”json”,
						async: false
					}).responseText;
					// Create our data table out of JSON data loaded from server.
					var data = new google.visualization.DataTable(jsonData);
					var options = {
						width: 800, height: 480,
						title: ‘Company Performance’
					};
					var chart = new google.visualization.LineChart(document.getElementById(‘chart_div’));
					chart.draw(data, options);
				}
			</script>
			<div id="chart_div" style="width: 900px; height: 500px;"></div>
		
			<div class="footer text-center">
				Copyright at <strong>K2V</strong> in 2013 Fusion Project Class
			</div>
		</div><!-- /.container -->
	</body>
</html>