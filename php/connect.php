<?php

// Make a MySQL Connection
$host="den1.mysql4.gear.host";
$user="calendarmain";
$password="sns_N_14_870";
$db = "calendarmain";

$link = mysqli_connect($host, $user, $password);
mysqli_select_db($link, $db) or die(mysqli_error($link));

?>
