<?php
include ("config.inc.php");

$result = $mysqli->query("SELECT raw_data, idi_data FROM dust_data ORDER BY id DESC LIMIT 0, 1");
$obj = $result->fetch_object();

$raw = $obj->raw_data;
$idi = $obj->idi_data;
$idi_string = "";
switch($idi){
	case 0:
		$idi_string = "Good";
		break;
	case 1:
		$idi_string = "Not Bad";
		break;
	case 2:
		$idi_string = "Severe";
		break;
}

$result->close();

$result = $mysqli->query("SELECT max_val FROM max_data ORDER BY id DESC LIMIT 0, 1");
$obj = $result->fetch_object();
$max_data = $obj->max_val;
$result->close();
//$time = strtotime($dateInUTC.'KST');
//$dateInLocal = date("Y-m-d H:i:s",$time);

include ("header.php");
?>
			
			<div id="top-row" class="row">
				<div id="symbol-info" class="grid-block col-md-6 col-lg-6 text-center">
						<span id="symbol-label" class="grid-label">Indoor</br> Dust Index</span></br>
						<strong><span id="symbol-val"><?php echo $idi_string; ?></span></strong>
				</div>
				<div id="time-info" class="grid-block col-md-6 col-lg-6 text-center">
						<span id="clock-label" class="grid-label">Time</span></br>
						<strong><span id="clock">Wait...</br>Server</span></strong>
				</div>
			</div>
			<div class="row">
				<div id="max-info" class="grid-block col-md-6 col-lg-6 text-center">
						<span id="max-label" class="grid-label">Today's</br> Max Value</span></br>
						<strong><span id="max-val"><?php echo $max_data; ?></span></strong>
					
				</div>
				<div id="dust-info" class="grid-block col-md-6 col-lg-6 text-center">
						<span id="dust-label" class="grid-label">Current</br> Dust Value</span></br>
						<strong><span id="dust-val"><?php echo $raw;?></span></strong>
				</div>
			</div>
			
			<div class="footer text-center">Copyright at <strong>K2V</strong> in 2013 Fusion Project Class</div>
		</div><!-- /.container -->
		<script>
				jQuery(document).ready(function() {
					var idi = parseInt(<?= $idi; ?>);// idi_number;
					switch (idi) {
						case 0:
							jQuery("#symbol-info").css( {"background-color": "#f5bb63" });
						  	break;
						case 1:
						 	jQuery("#symbol-info").css( {"background-color": "#e8703e" });
						  	break;
						case 2:
						 	jQuery("#symbol-info").css( {"background-color": "#d33431" });
						  	break;
						default:
						  $("#symbol-info").css( {"background-color": "#f5bb63" });
					}
				});
		</script>
	</body>
</html>