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

//include ("header.php");
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

		<title>Real-time Indoor Dust Monitor Page</title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap-theme.min.css">

		<!-- Custom styles for this template -->
		<link rel="stylesheet" href="./static/css/dust-portal.css" >
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

		<!-- Just for debugging purposes. Don't actually copy this line! -->
		<!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<!-- Load Google JSAPI -->
    	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript" src="./static/js/dust-portal.js"></script>
	</head>

	<body>
		<div class="container">
			<nav id="navigation" class="navbar navbar-default" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
					    <span class="icon-bar"></span>
					    <span class="icon-bar"></span>
				  	    <span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" id="title-bar" href="http://117.16.146.81/dust-portal/">Real-time Indoor Dust Monitoring Dashboard</a>
				</div>
				
				  <!-- Collect the nav links, forms, and other content for toggling -->
				  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a id="home" href="http://117.16.146.81/dust-portal/"><span class="glyphicon glyphicon-home"> Home</span></a></li>
						<li><a id="list"href="http://117.16.146.81/dust-portal/list.php"><span class="glyphicon glyphicon-list"> List</a></li>
						<li><a id="chart"href="http://117.16.146.81/dust-portal/chart.php"><span class="glyphicon glyphicon-stats"> Chart</a></li>
						<li><a id="settings"href="http://117.16.146.81/dust-portal/settings.php"><span class="glyphicon glyphicon-cog"> Settings</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>



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
					  			<div id="current-val" class="data-box col-md-4 col-xs-12">
					  				<span id="max-label" class="grid-label">Current Value</span></br>
									<strong><span id="max-val"><?php echo $raw_data; ?></span></strong>
					  			</div>
					  			<div id="max-val" class="data-box col-md-4 col-xs-12">
					  				<span id="max-label" class="grid-label">Max Value</span></br>
									<strong><span id="max-val"><?php echo $max_data; ?></span></strong>
					  			</div>
					  			<div id="min-val" class="data-box col-md-4 col-xs-12">
					  				<span id="max-label" class="grid-label">Min Value</span></br>
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
					jQuery("#notbad-progress-bar").css({"width": "<?php echo $notbad_ratio."%";?>"});
					jQuery("#severe-progress-bar").css({"width": "<?php echo $severe_ratio."%";?>"});
				});
		</script>
	</body>
</html>