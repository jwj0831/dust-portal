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

include ("header.php");
?>
			<form method="post" role="form" action="./setting_update.php">
				<div class="form-group">
			    	<label for="lc">Lower Constant: </label>
			    	<input type="text" class="form-control" id="lc" name="lc" value="<?php echo $lc;?>">
			  	</div>
			  	<div class="form-group">
			    	<label for="lrc">Lower Constant Frequency: </label>
			    	<input type="text" class="form-control" id="lrc" name="lrc" value="<?php echo $lrc;?>">
			  	</div>
			  	<div class="form-group">
			    	<label for="mc">Middle Constant: </label>
			    	<input type="text" class="form-control" id="mc" name="mc" value="<?php echo $mc;?>">
			  	</div>
			  	<div class="form-group">
			    	<label for="mrc">Middle Constant Frequency: </label>
			    	<input type="text" class="form-control" id="mrc" name="mrc" value="<?php echo $mrc;?>">
			  	</div>
			  	<div class="form-group">
			    	<label for="hc">Higher Constant: </label>
			    	<input type="text" class="form-control" id="hc" name="hc" value="<?php echo $hc;?>">
			  	</div>
			  	<div class="form-group">
			    	<label for="hrc">Higher Constant Frequency: </label>
			    	<input type="text" class="form-control" id="hrc" name="hrc" value="<?php echo $hrc;?>">
			  	</div>
			  	<div class="form-group">
			    	<label for="window">Window Size: </label>
			    	<input type="text" class="form-control" id="window" name="window" value="<?php echo $window;?>">
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
		<script src="./static/js/nav.js"></script>
	</body>
</html>