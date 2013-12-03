<?php
include("config.inc.php"); //include config file
$result = $mysqli->query("SELECT timestamp, raw_data, FROM dust_data ORDER BY id DESC LIMIT 0, 20");
$obj = $result->fetch_object();

$data[0] = array('time','dust_cnt');
for($i=1; $i<21; $i++ ){
	$data[$i] = array($obj->timestamp, $obj->raw_data );
	
}
echo json_encode($data);

$result->close();
?>