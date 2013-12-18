<?php
include ("config.inc.php");

$result = $mysqli->query("SELECT raw_data, idi_data FROM dust_data ORDER BY id DESC LIMIT 0, 1");
$obj = $result->fetch_object();

$raw_data = $obj->raw_data;
$idi = $obj->idi_data;

$result->free();

$result = $mysqli->query("SELECT max_val FROM max_data ORDER BY id DESC LIMIT 0, 1");
$obj = $result->fetch_object();
$max_data = $obj->max_val;

$result->free();
$mysqli->close();
//$time = strtotime($dateInUTC.'KST');
//$dateInLocal = date("Y-m-d H:i:s",$time);

include ("header.php");
?>
			<div id="first-row" class="row">
				<div class="col-md-3 col-xs-12">
					<div class="panel panel-default">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Current Indoor Dust Index</h3>
					  	</div>
					  	<div class="panel-body">
				    		<div id="symbol-info" class="text-center">
<?php
	switch($idi){
		case 0:
			echo '<i class="fa fa-smile-o"></i><span id="symbol-val">Good</span>';
			break;
			
		case 1:
			echo '<strong><span id="symbol-val">Not Bad</span></strong> <i class="fa fa-meh-o"></i>';
			break;
			
		case 2:
			echo '<strong><span id="symbol-val">Severe</span></strong> <i class="fa fa-frown-o"></i>';
			break;
	}
?>
							</div>
					  	</div>
					</div>
				</div>
				<div class="col-md-9 col-xs-12">
					<div class="panel panel-default">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Tdoay IDI Ratio</h3>
					  	</div>
					  	<div class="panel-body">
							<div id="time-info" class="text-center">
								<!--
								<span id="clock-label" class="grid-label">Time</span></br>
								<strong><span id="clock">Wait...</br>Server</span></strong>
								-->
								<strong>Good</strong>
						  		<label id="good-ratio-label" class="pull-right"></label>
							  	<div class="progress">
							  		<div id="good-progress-bar" class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 33%">
							    		<span id="good-ratio-span" class="sr-only"></span>
							  		</div>
								</div>
							  	<strong>Not bad</strong>
							  	<label id="not-bad-ratio-label" class="pull-right"></label>
								<div class="progress">
							  		<div id="not-bad-progress-bar" class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 33%">
							    		<span id="not-bad-ratio-span" class="sr-only"></span>
							  		</div>
								</div>
							  	<strong>Severe</strong>
							  	<label id="severe-ratio-span" class="pull-right"></label>
								<div class="progress">
							  		<div id="severe-progress-bar" class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 33%">
							    		<span id="severe-ratio-span" class="sr-only"></span>
							  		</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- #first-row -->
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="panel panel-default">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Current Indoor Dust Index</h3>
					  	</div>
					  	<div class="panel-body">
					  		<div id="time-info" class="text-center">
								<span id="max-label" class="grid-label">Today's</br> Max Value</span></br>
								<strong><span id="max-val"><?php echo $max_data; ?></span></strong>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="panel panel-default">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Current Indoor Dust Index</h3>
					  	</div>
					  	<div class="panel-body">
					  		<div id="time-info" class="text-center">
								<span id="dust-label" class="grid-label">Current</br> Dust Value</span></br>
								<strong><span id="dust-val"><?php echo $raw_data;?></span></strong>
							</div>
						</div>
					</div>
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