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
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js"></script>
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
					<a class="navbar-brand" id="title-bar" href="http://117.16.146.81/dust-portal/">Indoor Dust Monitoring Page</a>
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