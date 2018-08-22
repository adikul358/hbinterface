<?php

require 'conn.php';

// $clear_query = 'DELETE FROM conr';
// $result = mysqli_query($link, $clear_query);

$tables = array("senl");

foreach ($tables as $table) {
    echo "//Table: " . $table . "<br><br>";

    $d = 1;

    $n = rand(0,10);
    $date = date("Y\-m\-d", mktime(0,0,0,8, $d, 2018));
    for ($j=1; $j<$n+1; $j++) {
        $query = "INSERT INTO " . $table . " (date) VALUES ('$date')";
        $result = mysqli_query($link, $query);
        if(!$result) {
                die(mysqli_error($link));
            } else {
                $html = "";
            $html .= "Date=> " . $date;
            $html .= "Query no.=>" . $j;
            $html .= " //Inserted Successfully<br>";
            echo $html;
        }
    }
    echo "<br>";
    while ($d<30) {
        $n = rand(0,10);
        $date = date("Y\-m\-d", mktime(0,0,0,8, $d+=rand(1,6), 2018));
        for ($j=1; $j<$n+1; $j++) {
            $query = "INSERT INTO " . $table . " (date) VALUES ('$date')";
            $result = mysqli_query($link, $query);
            if(!$result) {
                    die(mysqli_error($link));
                } else {
                    $html = "";
                $html .= "Date=> " . $date;
                $html .= "Query no.=>" . $j;
                $html .= " //Inserted Successfully<br>";
                echo $html;
            }
        }
        echo "<br>";
    }
    echo "<br><br>";
}

?>
