<?php
include ("config.inc.php");

$result = $mysqli->query("SELECT * FROM dust_conf");
$obj = $result->fetch_object();
$lc = $obj->lc;
$lrc = $obj->lrc;
$mc = $obj->mc;
$mrc = $obj->mrc;
$hc = $obj->hc;
$hrc = $obj->hrc;
$window = $obj->window;

$result->close();

include ("header.php");
?>
	
			<div id="chart_div" style="width: 900px; height: 500px;"></div>
						
			<div class="footer text-center">Copyright at <strong>K2V</strong> in 2013 Fusion Project Class</div>
		</div><!-- /.container -->
	</body>
</html>