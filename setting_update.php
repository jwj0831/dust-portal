<?php
include ("config.inc.php");
$window = $_POST['pws'];
$hc = $_POST['hrc'];
$hrc = $_POST['rfhrc'];
$mc = $_POST['mrc'];
$mrc = $_POST['rfmrc'];

$stmt = $mysqli->prepare("UPDATE dust_conf SET pws = ?, hrc = ?, rfhrc = ?, mrc = ?, rfmrc = ? WHERE id = 1");
$stmt->bind_param('iiiii', $pws, $hrc, $rfhrc, $mrc, $rfmrc );
$stmt->execute();
$stmt->close();
$mysqli->close();

header("Location: http://117.16.146.81/dust-portal");
exit();
?>