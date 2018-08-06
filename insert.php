<?php
    require "connect.php";
    // $query = "DELETE FROM bookings";
    // $result = mysqli_query($link, $query);
    // if(!$result) {
    //         die(mysqli_error($link));
    // }
    for ($i=19; $i<31; $i++) {
        $n = rand(0,10);
        $date = date("Y\-m\-d", mktime(0,0,0,8, $i+1, 2018));
        for ($j=1; $j<$n+1; $j++) {
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