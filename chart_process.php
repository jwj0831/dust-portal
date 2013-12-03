<?php

echo '{ "cols": [ {"id":"","label":"year","type":"string"}, {"id":"","label":"sales","type":"number"}, {"id":"","label":"expenses","type":"number"}],
		"rows": [ {"c":[{"v":"2001"},{"v":3},{"v":5}]}, {"c":[{"v":"2002"},{"v":5},{"v":10}]}, {"c":[{"v":"2003"},{"v":6},{"v":4}]}, {"c":[{"v":"2004"},{"v":8},{"v":32}]},{"c":[{"v":"2005"},{"v":3},{"v":56}]}]}';

/*
include("config.inc.php"); //include config file
$result = $mysqli->query("SELECT timestamp, raw_data, FROM dust_data ORDER BY id DESC LIMIT 0, 20");
$rows = $result->fetch_all(MYSQLI_ASSOC);

$data[0] = array('time','dust_cnt');
$i=1;
foreach($result->fetch_all(MYSQLI_ASSOC)){
	$data[$i++] = array($row['timestamp'], doubleval($row['raw_data']));
}

echo json_encode($data);

$result->free();
$mysqli->close();
 
 */
?>