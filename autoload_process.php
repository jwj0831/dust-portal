<?php
include("config.inc.php"); //include config file

//sanitize post value						 
$group_number = filter_var($_POST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

//throw HTTP error if group number is not valid
if(!is_numeric($group_number)){
    header('HTTP/1.1 500 Invalid number!');
    exit();
}

//get current starting point of records
$position = ($group_number * $items_per_group);

//Limit our results within a specified range. 
$results = $mysqli->query("SELECT id, val FROM dustVal ORDER BY id ASC LIMIT  $position, $items_per_group");

if ($results) { 
    //output results from database
    
    while($obj = $results->fetch_object())
    {
        echo '<div class="col-lg"><span class="default-label-info"> '. $row["id"] . '</span> <span class="badge">' . $row["val"] . '</span></div>';
	}

}
unset($obj);
$mysqli->close();
?>