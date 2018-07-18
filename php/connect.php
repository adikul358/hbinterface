<?php

// Make a MySQL Connection
$host="localhost";
$user="root";
$password="";
$db = "wch";

$link = mysqli_connect($host, $user, $password);
mysqli_select_db($link, $db) or die(mysqli_error($link));

?>
