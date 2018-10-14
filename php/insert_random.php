<?php

require 'conn.php';

$clear_query = 'DELETE FROM wch';
$result = mysqli_query($link, $clear_query);
$sql_query = "";
$halls = ["conr", "cotel", "gym", "meer", "senl", "wch"];

foreach ($halls as $hall) {
    for ($i=0; $i<31;$i++) {
        $d = $i + 10;

        $n = rand(0,10);
        $date = date("Y\-m\-d", mktime(0,0,0,10, $d, 2018));
        for ($j=$i+1; $j>0; $j--) {
            $query = "INSERT INTO $hall (date, slot_no) VALUES ('$date', $j)";
            $sql_query .= "\n$query;";
        }
        $sql_query .= "\n";
    }
}

$sql_file = fopen("insert.sql", "w");
$sql_file = fwrite($sql_query);

?>