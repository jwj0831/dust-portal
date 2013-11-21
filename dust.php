<?php
include ("config.inc.php");

$results = $mysqli -> query("SELECT COUNT(*) as t_records FROM dust_val");
$total_records = $results -> fetch_object();
$total_groups = ceil($total_records -> t_records / $items_per_group);
$results -> close();

$dt = new DateTime();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!--<meta http-equiv='refresh' content='30;url=http://117.16.146.81/dust-portal'>-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="./static/favicon.ico" type="image/x-icon">
		<link rel="icon" href="./static/favicon.ico" type="image/x-icon">

		<title>Real time Dust Monitoring System</title>

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
				<h3 class="text-muted text-center"><a href="http://117.16.146.81/dust-portal/dust.php">Real-time Dust Monitoring System</a></h3>
				<!--
				<ul class="nav nav-pills pull-right">
					<li><a id="home" class="active" href="#">Home</a></li>
					<li><a id="settings"href="#">Settings</a></li>
					<li><a id="about" href="#">About</a></li>
				</ul>
				-->
			</div>
			
			<div class="row" id="main">
				<div id="symbol-info" class="col-md-6 col-lg-6">
					<p class="text-primary text-center">Dust Standard</p>
					<div id="symbol"></div>
				</div>
				<div id="text-info" class="col-md-6 col-lg-6">
					<div id="today-time">
						<p class="text-primary text-val"><strong>Current Time: <?php echo $dt->format('Y-m-d H:i:s'); ?></strong></p>
					</div>
					<div id="today-max">
						<p class="text-danger text-val"><strong>Today's Max Value: ...</strong></p>
					</div>
					<div id="today-now">
						<p class="text-success text-val"><strong>Current Value: ...</strong></p>
					</div>
				</div>
				
			</div>
			
		</div><!-- /.container -->

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
	</body>
</html>