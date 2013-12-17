<?php
header("Content-type: text/json");

include("config.inc.php"); //include config file

$result = $mysqli->query("SELECT timestamp, raw_data, idi_data FROM dust_data ORDER BY id DESC LIMIT 1");
$rows = $result->fetch_array(MYSQLI_ASSOC);
/*
$data['cols'][] = array('type' => 'string', 'label' => 'timestamp');
$data['cols'][] = array('type' => 'number', 'label' => 'raw_data');
$data['cols'][] = array('type' => 'number', 'label' => 'IDI');

for($i=49; $i >= 0 ; $i--){
	$row = $rows[$i];
	$data['rows'][] = array('c' => array( array('v' => $row['timestamp']), array('v' => $row['raw_data']),array('v' => $row['idi_data']) ) );
}
*/
$data = array($rows['timestamp'], $rows['idi_data']);
echo json_encode($data);

$result->free();
$mysqli->close();
?>