<?php
include ("config.inc.php");
$pws = $_POST['pws'];
$hrc = $_POST['hrc'];
$rfhrc = $_POST['rfhrc'];
$mrc = $_POST['mrc'];
$rfmrc = $_POST['rfmrc'];

$stmt = $mysqli->prepare("UPDATE dust_conf SET pws = ?, hrc = ?, rfhrc = ?, mrc = ?, rfmrc = ? WHERE id = 1");
$stmt->bind_param('iiiii', $pws, $hrc, $rfhrc, $mrc, $rfmrc );
$stmt->execute();
$stmt->close();
$mysqli->close();

header("Location: http://117.16.146.81/dust-portal");
exit();
?>