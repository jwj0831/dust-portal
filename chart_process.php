<?php
include("config.inc.php"); //include config file
$result = $mysqli->query("SELECT timestamp, raw_data, FROM dust_data ORDER BY id DESC LIMIT 0, 20");
$rows = $result->fetch_all(MYSQLI_ASSOC);

$data[0] = array('time','dust_cnt');
$i=1;
foreach($rows as $row){
	$data[$i++] = array($row['timestamp'], doubleval($row['raw_data']));
}

echo json_encode($data);

$result->free();
$mysqli->close();
?>