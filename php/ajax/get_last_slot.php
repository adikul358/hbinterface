<?php
    require '../functions.php';
    $check = time_slots_display(date("Y-m-d", strtotime("today")), false);
    if ($check) {
        echo "true";
    }
?>