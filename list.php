<?php
include ("config.inc.php");

$results = $mysqli -> query("SELECT COUNT(*) as t_records FROM dust_data");
$total_records = $results -> fetch_object();
$total_groups = ceil($total_records -> t_records / $items_per_group);
$result->free();
$mysqli->close();

include ("header.php");
?>
			<div id="results">
			</div>
			<div class="animation_image" style="display:none" align="center">
				<img src="ajax-loader.gif">
			</div>
		</div><!-- /.container -->
		<footer>
			<p class="footer">
				Copyright at NFM in 2013
			</p>
		</footer>

		<script>
			jQuery(document).ready(function() {
				var track_load = 0; //total loaded record group(s)
				var loading  = false; //to prevents multipal ajax loads
				var total_groups = <?php echo $total_groups; ?>;//total record group(s)

				jQuery('#results').load("autoload_process.php", {'group_no' : track_load}, function() {track_load++;}); //load first group

				jQuery(window).scroll(function() {//detect page scroll
					if (jQuery(window).scrollTop() + jQuery(window).height() == jQuery(document).height())//user scrolled to bottom of the page?
					{
						if (track_load <= total_groups && loading == false)//there's more data to load
						{
							loading = true;	//prevent further ajax loading
							jQuery('.animation_image').show(); //show loading image

							//load data from the server using a HTTP POST request
							jQuery.post('autoload_process.php', {'group_no' : track_load}, function(data) {

								jQuery("#results").append(data);//append received data into the element

								//hide loading image
								jQuery('.animation_image').hide();//hide loading image once data is received

								track_load++;
								//loaded group increment
								loading = false;

							}).fail(function(xhr, ajaxOptions, thrownError) {//any errors?

								alert(thrownError);//alert with HTTP error
								jQuery('.animation_image').hide();//hide loading image
								loading = false;

							});
	
						}
					}
				});
			});
		</script>
	</body>
</html>