<?php
include ("config.inc.php");	//include config file

//sanitize post value
$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

//throw HTTP error if page number is not valid
if (!is_numeric($page_number)) {
	header('HTTP/1.1 500 Invalid page number!');
	exit();
}

//get current starting point of records
$position = ($page_number * $item_per_page);

//Limit our results within a specified range.
$results = mysqli_query($conn, "SELECT id, val FROM dustVal ORDER BY id DESC LIMIT $position, $item_per_page");

//output results from database
while ($row = mysqli_fetch_array($results)) {
	echo '<div class="col-lg"><span class="default-label-info"> '. $row["id"] . '</span> <span class="badge">' . $row["val"] . '</span></div>';
}
?>

