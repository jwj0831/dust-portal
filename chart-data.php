<?php
/* Test Codes
echo '{ "cols": [ {"id":"","label":"year","type":"string"}, {"id":"","label":"sales","type":"number"}, {"id":"","label":"expenses","type":"number"}],
		"rows": [ {"c":[{"v":"2001"},{"v":3},{"v":5}]}, {"c":[{"v":"2002"},{"v":5},{"v":10}]}, {"c":[{"v":"2003"},{"v":6},{"v":4}]}, {"c":[{"v":"2004"},{"v":8},{"v":32}]},{"c":[{"v":"2005"},{"v":3},{"v":56}]}]}';
*/

// Set the JSON header
header("Content-type: text/json");

// The x value is the current JavaScript time, which is the Unix time multiplied 
// by 1000.
$x = time() * 1000;
// The y value is a random number
$y = rand(0, 100);

// Create a PHP array and echo it as JSON
$ret = array($x, $y);
echo json_encode($ret);

/*
include("config.inc.php"); //include config file

$result = $mysqli->query("SELECT timestamp, raw_data, idi_data FROM dust_data ORDER BY id DESC LIMIT 0, 50");
$rows = $result->fetch_all(MYSQLI_ASSOC);

$data['cols'][] = array('type' => 'string', 'label' => 'timestamp');
$data['cols'][] = array('type' => 'number', 'label' => 'raw_data');
$data['cols'][] = array('type' => 'number', 'label' => 'IDI');

for($i=49; $i >= 0 ; $i--){
	$row = $rows[$i];
	$data['rows'][] = array('c' => array( array('v' => $row['timestamp']), array('v' => $row['raw_data']),array('v' => $row['idi_data']) ) );
}

echo json_encode($data);

$result->free();
$mysqli->close();
*/
?>