<?php
include ("config.inc.php");

$result = $mysqli->query("SELECT raw_data, idi_data FROM dust_data ORDER BY id DESC LIMIT 1");
$obj = $result->fetch_object();

$raw_data = $obj->raw_data;
$idi = $obj->idi_data;

$result->free();

$result = $mysqli->query("SELECT max_val, min_val, good_ratio, notbad_ratio, severe_ratio FROM stat_data ORDER BY id DESC LIMIT 1");
$obj = $result->fetch_object();
$max_data = $obj->max_val;
$min_data = $obj->min_val;
$good_ratio = $obj->good_ratio;
$notbad_ratio = $obj->notbad_ratio;
$severe_ratio = $obj->severe_ratio;

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
			echo '<i class="fa fa-smile-o"></i><span class="idi-string" id="symbol-val">Good</span>';
			break;
			
		case 1:
			echo '<i class="fa fa-meh-o"></i><span class="idi-string" id="symbol-val">Not Bad</span>';
			break;
			
		case 2:
			echo '<i class="fa fa-frown-o"></i><span class="idi-string" id="symbol-val">Severe</span>';
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
					    	<h3 class="panel-title">Today's IDI Ratio</h3>
					  	</div>
					  	<div class="panel-body">
							<div id="ratio-info" class="">
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
							  	<label id="notbad-ratio-label" class="pull-right"></label>
								<div class="progress">
							  		<div id="notbad-progress-bar" class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 33%">
							    		<span id="notbad-ratio-span" class="sr-only"></span>
							  		</div>
								</div>
							  	<strong>Severe</strong>
							  	<label id="severe-ratio-label" class="pull-right"></label>
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
				<div class="col-md-12 col-xs-12">
					<div class="panel panel-default">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Current Indoor Dust Figures</h3>
					  	</div>
					  	<div class="panel-body">
					  		<div id="dust-info" class="text-center">
					  			<div id="current-val">
					  				<span id="max-label" class="grid-label">Today's</br> Current Value</span></br>
									<strong><span id="max-val"><?php echo $raw_data; ?></span></strong>
					  			</div>
					  			<div id="max-val">
					  				<span id="max-label" class="grid-label">Today's</br> Max Value</span></br>
									<strong><span id="max-val"><?php echo $max_data; ?></span></strong>
					  			</div>
					  			<div id="min-val">
					  				<span id="max-label" class="grid-label">Today's</br> Min Value</span></br>
									<strong><span id="max-val"><?php echo $min_data; ?></span></strong>
					  			</div>
								
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
							jQuery("#symbol-info").css( {
														"background-image" : "-webkit-gradient(linear,left 0,left 100%,from(#5bc0de),to(#31b0d5))",
														"background-image" : "-webkit-linear-gradient(top,#5bc0de 0,#31b0d5 100%)",
														"background-image" : "-moz-linear-gradient(top,#5bc0de 0,#31b0d5 100%)",
														"background-image" : "linear-gradient(to bottom,#5bc0de 0,#31b0d5 100%)",
														"background-repeat" : "repeat-x"
														});
						  	break;
						case 1:
						 	jQuery("#symbol-info").css( {
														"background-image" : "-webkit-gradient(linear,left 0,left 100%,from(#f0ad4e),to(#ec971f))",
														"background-image" : "-webkit-linear-gradient(top,#f0ad4e 0,#ec971f 100%)",
														"background-image" : "-moz-linear-gradient(top,#f0ad4e 0,#ec971f 100%)",
														"background-image" : "linear-gradient(to bottom,#f0ad4e 0,#ec971f 100%)",
														"background-repeat" : "repeat-x"
														});
						  	break;
						case 2:
						 	jQuery("#symbol-info").css( {
														"background-image" : "-webkit-gradient(linear,left 0,left 100%,from(#d9534f),to(#c9302c))",
														"background-image" : "-webkit-linear-gradient(top,#d9534f 0,#c9302c 100%)",
														"background-image" : "-moz-linear-gradient(top,#d9534f 0,#c9302c 100%)",
														"background-image" : "linear-gradient(to bottom,#d9534f 0,#c9302c 100%)",
														"background-repeat" : "repeat-x"
														});
						  	break;
						default:
						  $("#symbol-info").css( {
														"background-image" : "-webkit-gradient(linear,left 0,left 100%,from(#5bc0de),to(#31b0d5))",
														"background-image" : "-webkit-linear-gradient(top,#5bc0de 0,#31b0d5 100%)",
														"background-image" : "-moz-linear-gradient(top,#5bc0de 0,#31b0d5 100%)",
														"background-image" : "linear-gradient(to bottom,#5bc0de 0,#31b0d5 100%)",
														"background-repeat" : "repeat-x"
														});
					}
					
					jQuery("#good-ratio-label").text("<?php echo $good_ratio."%" ;?>");
					jQuery("#notbad-ratio-label").text("<?php echo $notbad_ratio."%" ;?>");
					jQuery("#severe-ratio-label").text("<?php echo $severe_ratio."%" ;?>");
					jQuery("#good-progress-bar").css({"width": "<?php echo $good_ratio."%";?>"});
					jQuery("#notabd-progress-bar").css({"width": "<?php echo $notbad_ratio."%";?>"});
					jQuery("#severe-progress-bar").css({"width": "<?php echo $severe_ratio."%";?>"});
				});
		</script>
	</body>
</html>