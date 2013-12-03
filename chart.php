<?php
include ("header.php");
?>
<script>
	google.load("visualization", "1", { packages: ["corechart"] });
        google.setOnLoadCallback(drawChart);

        function drawChart() {
            var jsonData = jQuery.ajax({
                url: "chart_process.php",
                dataType: "json",
                async: false
            }).responseText;

            var obj = window.JSON.stringify(jsonData);
            var data = google.visualization.arrayToDataTable(obj);

            var options = {
                title: 'Raw Dust Value'
            };

            var chart = new google.visualization.LineChart(
                        document.getElementById('chart_div'));
            chart.draw(data, options);
        }
</script>
			<div id="chart_div" style="width: 900px; height: 500px;"></div>
						
			<div class="footer text-center">Copyright at <strong>K2V</strong> in 2013 Fusion Project Class</div>
		</div><!-- /.container -->
	</body>
</html>