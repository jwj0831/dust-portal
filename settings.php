<?php
include ("config.inc.php");

$result = $mysqli->query("SELECT * FROM dust_conf");
$obj = $result->fetch_object();
$hrc = $obj->hrc;
$rfhrc = $obj->rfhrc;
$mrc = $obj->mrc;
$rfmrc = $obj->rfmrc;
$pws = $obj->pws;

$result->free();
$mysqli->close();

include ("header.php");
?>
			<form method="post" role="form" action="./setting_update.php">
				<div class="form-group">
			    	<label for="window">Past Window Size: </label>
			    	<input type="text" class="form-control" id="pws" name="pws" value="<?php echo $pws;?>">
			    	<p class="help-block">This number means how many past records are used for deciding IDI.</p>
			  	</div>
				<div class="form-group">
			    	<label for="hc">HRC(Higher Reference Constant): </label>
			    	<input type="text" class="form-control" id="hrc" name="hrc" value="<?php echo $hrc;?>">
					<p class="help-block">This reference number is compared with the latest list's figures in past window for counting how many figures are higher than HRC, itself.</p>
			  	</div>
			  	<div class="form-group">
			    	<label for="hrc">RFHRC(Reference Frequency of HRC): </label>
			    	<input type="text" class="form-control" id="rfhrc" name="rfhrc" value="<?php echo $rfhrc;?>">
			    	<p class="help-block">The minimum reference number for deciding "severe" index.</p>
			  	</div>
			  	<div class="form-group">
			    	<label for="mc">MRC(Middle Reference Constant): </label>
			    	<input type="text" class="form-control" id="mrc" name="mrc" value="<?php echo $mrc;?>">
			    	<p class="help-block">This reference number is compared with the latest list's figures in past window for counting how many figures are higher than MRC, itself.</p>
			  	</div>
			  	<div class="form-group">
			    	<label for="mrc">RFHRC(Reference Frequency of MRC): </label>
			    	<input type="text" class="form-control" id="rfmrc" name="rfmrc" value="<?php echo $rfmrc;?>">
			    	<p class="help-block">The minimum reference number for deciding "not bad" index.</p>
			  	</div>			  	
			 	 <button type="submit" class="btn btn-default">Submit</button>
			</form>
						
			<div class="footer text-center">Copyright at <strong>K2V</strong> in 2013 Fusion Project Class</div>
		</div><!-- /.container -->
	</body>
</html>