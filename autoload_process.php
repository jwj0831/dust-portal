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
        echo '<tr> <th scope="row">'.$obj->id.'</th><td>'.$obj->timestamp.'</td><td>'.$obj->raw_data.'</td><td>'.$obj->idi_data.'</td>';          
	}

}
unset($obj);
$result->free();
$mysqli->close();
?>