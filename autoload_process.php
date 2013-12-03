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
$results = $mysqli->query("SELECT * FROM dust_data ORDER BY id DESC LIMIT  $position, $items_per_group");

if ($results) { 
    //output results from database
    
    while($obj = $results->fetch_object())
    {
    	$idi_string = "";
		switch($obj->idi_data){
			case 0:
				$idi_string = "Good";
				break;
			case 1:
				$idi_string = "Not Bad";
				break;
			case 2:
				$idi_string = "Severe";
				break;
		}
        echo '<tr><th>'.$obj->timestamp.'</th><td>'.$obj->raw_data.'</td><td>'.$idi_string.'</td>';          
	}

}
unset($obj);
$results->free();
$mysqli->close();
?>