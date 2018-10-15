<?php

require 'conn.php';

$sql_query = "";
$halls = ["conr", "cotel", "gym", "meer", "senl", "wch"];

foreach ($halls as $hall) {
    $sql_query .= "\nDELETE FROM $hall;";
    for ($i=0; $i<18;$i++) {
        $d = $i + 14;
        $n = rand(0,10);
        $date = date("Y\-m\-d", mktime(0,0,0,10, $d, 2018));
        for ($j=$n+1; $j>0; $j--) {
            $query = "    INSERT INTO $hall (date, slot_no) VALUES ('$date', $j)";
            $sql_query .= "\n$query;";
        }
        $sql_query .= "\n";
    }
}

$sql_file = fopen("insert.sql", "w");
$sql_file = fwrite($sql_file, $sql_query);

?>