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
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv='refresh' content='30;url=http://117.16.146.81/dust-portal'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="./static/favicon.ico" type="image/x-icon">
		<link rel="icon" href="./static/favicon.ico" type="image/x-icon">

		<title>Indoor Dust Monitor</title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap-theme.min.css">

		<!-- Custom styles for this template -->
		<link rel="stylesheet" href="./static/css/dust-portal.css" >

		<!-- Just for debugging purposes. Don't actually copy this line! -->
		<!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<div class="container">
			<div class="header">
				<h3 class="text-muted text-center"><a class="title" href="http://117.16.146.81/dust-portal/dust.php"><strong>Real-time Indoor Dust Monitoring System</strong></a></h3>
				<!--
				<ul class="nav nav-pills pull-right">
					<li><a id="home" class="active" href="#">Home</a></li>
					<li><a id="settings"href="#">Settings</a></li>
					<li><a id="about" href="#">About</a></li>
				</ul>
				-->
			</div>
			
			<div id="top-row" class="row">
				<div id="symbol-info" class="grid-block col-md-6 col-lg-6 text-center">
						<span id="symbol-label" class="grid-label">Indoor</br> Dust Index</span></br>
						<strong><span id="symbol-val"><?php echo $idi_string; ?></span></strong>
				</div>
				<div id="time-info" class="grid-block col-md-6 col-lg-6 text-center">
						<span id="clock-label" class="grid-label">Time</span></br>
						<strong><span id="clock"></span></strong>
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

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js"></script>
		<script type="text/javascript"> 
			new Ajax.PeriodicalUpdater('clock', 'clock.php', {method: 'get', frequency: 1 });
		</script>
		<script>
			$(document).ready(function() {
				var idi = parseInt(<?= $idi; ?>);// idi_number;
				switch (idi) {
					case 0:
						$("#symbol-info").css( {"background-color": "#f5bb63" });
					  	break;
					case 1:
					 	$("#symbol-info").css( {"background-color": "#e8703e" });
					  	break;
					case 2:
					 	$("#symbol-info").css( {"background-color": "#d33431" });
					  	break;
					default:
					  $("#symbol-info").css( {"background-color": "#f5bb63" });
					}
				});
		</script>
	</body>
</html>