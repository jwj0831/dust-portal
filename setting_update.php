<?php
include ("config.inc.php");
$lc = $_POST['lc'];
$lrc = $_POST['lrc'];
$mc = $_POST['mc'];
$mrc = $_POST['mrc'];
$hc = $_POST['hc'];
$hrc = $_POST['hrc'];
$window = $_POST['window'];

$stmt = $mysqli->prepare("UPDATE dust_conf SET lc = ?, lrc = ?, mc = ?, mrc = ?, hc = ?, hrc = ?, window = ? WHERE id = 1");
$stmt->bind_param('iiiiiii', $lc, $lrc, $mc, $mrc, $hc, $hrc, $window);
$stmt->execute();
$stmt->close();

header("Location: http://117.16.146.81/dust-portal");
exit();
?>