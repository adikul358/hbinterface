<?php

    $host="den1.mysql6.gear.host";
    $user="hbinterfacecal";
    $password="	Gq3T163qQw--";
    $db = "hbinterfacecal";

    $link = mysqli_connect($host, $user, $password, $db);
    if (!$link) {
        echo "<script>window.location.href = '/error/'</script>";
    }


?>