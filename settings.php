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
				<h3 class="text-muted text-center"><a class="title" href="http://117.16.146.81/dust-portal/"><strong>Real-time Indoor Dust Monitoring System</strong></a></h3>
				<ul class="nav nav-tabs nav-justified">
					<li><a id="home" href="http://117.16.146.81/dust-portal/">Home</a></li>
					<li class="active"><a id="settings"  href="http://117.16.146.81/dust-portal/settings.php">Settings</a></li>
				</ul>
			</div>
			
			<form method="post" role="form" action="./setting_update.php">
				<div class="form-group">
			    	<label for="lc">Lower Constant: </label>
			    	<input type="text" class="form-control" id="lc" value="<?php echo $lc;?>">
			  	</div>
			  	<div class="form-group">
			    	<label for="lrc">Lower Constant Frequency: </label>
			    	<input type="text" class="form-control" id="lrc" value="<?php echo $lrc;?>">
			  	</div>
			  	<div class="form-group">
			    	<label for="mc">Middle Constant: </label>
			    	<input type="text" class="form-control" id="mc" value="<?php echo $mc;?>">
			  	</div>
			  	<div class="form-group">
			    	<label for="mrc">Middle Constant Frequency: </label>
			    	<input type="text" class="form-control" id="mrc" value="<?php echo $mrc;?>">
			  	</div>
			  	<div class="form-group">
			    	<label for="hc">Higher Constant: </label>
			    	<input type="text" class="form-control" id="hc" value="<?php echo $hc;?>">
			  	</div>
			  	<div class="form-group">
			    	<label for="hrc">Higher Constant Frequency: </label>
			    	<input type="text" class="form-control" id="hrc" value="<?php echo $hrc;?>">
			  	</div>
			  	<div class="form-group">
			    	<label for="window">Window Size: </label>
			    	<input type="text" class="form-control" id="window" value="<?php echo $window;?>">
			  	</div>
			 	 <button type="submit" class="btn btn-default">Submit</button>
			</form>
						
			<div class="footer text-center">Copyright at <strong>K2V</strong> in 2013 Fusion Project Class</div>
		</div><!-- /.container -->

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js"></script>
	</body>
</html>