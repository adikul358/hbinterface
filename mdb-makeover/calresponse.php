<?php
    require "connect.php";

    $date = $_GET['q'];
    $ds = array();
    $ds = explode("_", $date);

    $curr = $ds[1];
    $curr = explode("-", $curr);
    $y = $curr[0];
    $m = $curr[1];
    $m++;
    $d = $curr[2];

    $currdate = date("Y\-m\-d", mktime(0,0,0,$m, $d, $y));
    
    $query = "SELECT * FROM bookings WHERE date='$currdate' ORDER BY start";
    $result = mysqli_query($link, $query);

    $slts = 0;
    $n = (int)mysqli_num_rows($result);
    $slts = 100 - floor(($n/11) * 100);
    $color = "";
        
        if ($n < 4) {
            $color = "rgba(35, 209, 0, 0.7)";
        } elseif ($n < 9) {
            $color = "rgba(230, 214, 0, 0.7)";
        } else {
            $color = "rgba(255, 0, 0, 0.7)";
        }
        $slts = 100 - floor(($n/11) * 100);
        
    $style = "linear-gradient(to bottom, transparent ";
    $style .= $slts. "%, ";
    $style .= $color ." ". $slts . "%)";

    echo $style

?>