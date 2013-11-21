<?php
include ("config.inc.php");

$results = $mysqli -> query("SELECT COUNT(*) as t_records FROM dust_val");
$total_records = $results -> fetch_object();
$total_groups = ceil($total_records -> t_records / $items_per_group);
$results -> close();
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
			<ul class="nav nav-pills pull-right">
				<li><a href="#">Home</a></li>
				<li><a href="#">Settings</a></li>
				<li><a href="#">About</a></li>
			</ul>
			<h3 class="text-muted">Real-time Dust Monitoring System</h3>
			
			<div class="jumbotron">
				<div id="symbol-info">
					<div id="symbol"></div>
				</div>
				<div id="text-info">
					<div id="today-time">
						<div class="alert alert-info">Current Time: ...</div>
					</div>
					<div id="today-max">
						<div class="alert alert-warning">Today's Max Value: ...</div>
					</div>
					<div id="today-now">
						<div class="alert alert-danger">Current Value: ...</div>
					</div>
				</div>
			</div><!-- /.jumbotron-->
			
			<div class="footer">
				<p>Copyright at K2V in 2013</p>
			</div>
		</div><!-- /.container -->

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
	</body>
</html>