<?php
include ("config.inc.php");

$results = $mysqli -> query("SELECT COUNT(*) as t_records FROM dust_data");
$total_records = $results -> fetch_object();
$total_groups = ceil($total_records -> t_records / $items_per_group);
$results -> close();

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
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
		<script src="./static/js/nav.js"></script>

		<script>
			$(document).ready(function() {
				var track_load = 0; //total loaded record group(s)
				var loading  = false; //to prevents multipal ajax loads
				var total_groups = <?php echo $total_groups; ?>;//total record group(s)

				$('#results').load("autoload_process.php", {'group_no' : track_load}, function() {track_load++;}); //load first group

				$(window).scroll(function() {//detect page scroll
					if ($(window).scrollTop() + $(window).height() == $(document).height())//user scrolled to bottom of the page?
					{
						if (track_load <= total_groups && loading == false)//there's more data to load
						{
							loading = true;	//prevent further ajax loading
							$('.animation_image').show(); //show loading image

							//load data from the server using a HTTP POST request
							$.post('autoload_process.php', {'group_no' : track_load}, function(data) {

								$("#results").append(data);//append received data into the element

								//hide loading image
								$('.animation_image').hide();//hide loading image once data is received

								track_load++;
								//loaded group increment
								loading = false;

							}).fail(function(xhr, ajaxOptions, thrownError) {//any errors?

								alert(thrownError);//alert with HTTP error
								$('.animation_image').hide();//hide loading image
								loading = false;

							});
	
						}
					}
				});
			});
		</script>
	</body>
</html>