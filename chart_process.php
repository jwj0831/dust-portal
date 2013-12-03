<?php
include("config.inc.php"); //include config file
$results = $mysqli->query("SELECT timestamp, raw_data, FROM dust_data ORDER BY id DESC LIMIT 0, 20");

$data[0] = array('time','dust_cnt');
$i=1;

while($obj = $results->fetch_object()){
	$data[$i++] = array($obj->timestamp, $obj->raw_data );	
}

echo json_encode($data);

$result->close();
?>