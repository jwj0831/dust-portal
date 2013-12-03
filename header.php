
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
		<script>
			var pathArray = window.location.pathname.split( '/' );
			var currentPage = pathArray[1];
			alert(currentPage);
			
			if(currentPage == "charts.php") {
				$("#home").parent().removeClass();
				$("#charts").parent().addClass("active");
				$("#settings").parent().removeClass();
			}
			else if(currentPage == "settings.php") {
				$("#home").parent().removeClass();
				$("#charts").parent().removeClass();
				$("#settings").parent().addClass("active");
			}
			else{
				$("#home").parent().addClass("active");
				$("#charts").parent().removeClass();
				$("#settings").parent().removeClass();
			}
			
		</script>
	</head>

	<body>
		<div class="container">
			<div class="header">
				<h3 class="text-muted text-center"><a class="title" href="http://117.16.146.81/dust-portal/"><strong>Real-time Indoor Dust Monitoring System</strong></a></h3>
				<ul class="nav nav-tabs nav-justified">
					<li class="active"><a id="home" href="http://117.16.146.81/dust-portal/">Home</a></li>
					<li><a id="charts"href="http://117.16.146.81/dust-portal/charts.php">Charts</a></li>
					<li><a id="settings"href="http://117.16.146.81/dust-portal/settings.php">Settings</a></li>
				</ul>
			</div>