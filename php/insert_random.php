<?php

require 'conn.php';

$clear_query = 'DELETE FROM wch';
$result = mysqli_query($link, $clear_query);


for ($i=0; $i<12;$i++) {
    $d = $i + 10;

    $n = rand(0,10);
    $date = date("Y\-m\-d", mktime(0,0,0,9, $d, 2018));
    for ($j=$i+1; $j>0; $j--) {
        $query = "INSERT INTO wch (date) VALUES ('$date')";
        $result = mysqli_query($link, $query);
        if(!$result) {
                die(mysqli_error($link));
            } else {
                $html = "";
            $html .= "Date=> " . $date;
            $html .= " Query no.=>" . $j;
            $html .= " //Inserted Successfully<br>";
            echo $html;
        }
    }
    echo "<br><br>";
}

?>