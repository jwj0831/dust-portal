<?php
$host_name = "localhost";
$user_name = "root";
$password = "1234";
$db_name = "dust";
$item_per_page = 10;

$conn = mysqli_connect($host_name, $user_name, $password, $db_name) or die('could not connect to database');
?>