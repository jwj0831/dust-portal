<?php
	$hostname = "localhost";
	$user_name = "root";
	$password = "0831";
	$db_name = "dust";
	$conn = mysql_connect($hostname, $user_name, $password);
	mysql_select_db($db_name, $conn);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Real time Dust Monitoring System</title>

    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap-theme.min.css">
	
	<!-- Custom styles for this template -->
    <link rel="stylesheet" href="./css/dust-portal.css" >
    
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Real Time Dust Monitoring System</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://117.16.146.55/dust-portal">Home</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="dust-template">
        <h1>Real-time dust monitoring</h1>
        <p class="lead">제 연구실 내 실시간 공기질을 모니터링하는 페이지 입니다.</p>
      </div>
      
      <div class="panel panel-default">
      	<div class="panel-heading">먼지측정 </div>
      	<div class="panel-body">매 30초마다 먼지센서로부터 값을 받아 최근 5분 동안의 값을 보여주고 있습니다.</div>
      	<div class="test">
      		<button type="button" class="btn btn-default btn-lg">
  				<span class="glyphicon glyphicon-star"></span> Star
			</button>
      	</div>
      	<table class="table">
      		<thead>
      			<th>#</th>
      			<th>Value</th>
      		</thead>
      		<tbody>
      			<?php
      				$query = "SELECT * FROM dustVal ORDER BY id DESC LIMIT 10";
					$result = mysql_query($query, $conn);
					while($row = mysql_fetch_array($result))
					{ 
      			?>
      			
      			<tr>
	      			<td>
	      				<?= $row['id'];  ?>
	      			</td>
	      			<td>
	      				<?= $row['val'];  ?>
	      			</td>
      			</tr>
      			<?php
					}
				?>
      		</tbody>
      	</table>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
  </body>
</html>