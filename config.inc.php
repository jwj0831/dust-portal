<?php
$host_name = "localhost";
$user_name = "root";
$password = "1234";
$db_name = "dust";
$items_per_group = 60;
//$item_per_page = 10;

//$conn = mysqli_connect($host_name, $user_name, $password, $db_name) or die('could not connect to database');
$mysqli = new mysqli($host_name , $user_name , $password, $db_name);

?>