<?php
    require "connect.php";
    for ($i=28; $i<31; $i++) {
        $n = rand(0,11);
        $date = date("Y\-m\-d", mktime(0,0,0,8, $i+1, 2018));
        for ($j=0; $j<$n+1; $j++) {
            $query = "INSERT INTO bookings (date) VALUES ('$date')";
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

?>