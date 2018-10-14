<?php
    require "conn.php";

    $sql_file = fopen("index_table.sql", "w");
    fwrite($sql_file, "");
    $sql_file = fopen("index_table.sql", "a");
    fwrite($sql_file, "DELETE FROM event_index;\n");

    $halls = ["conr", "cotel", "gym", "meer", "senl", "wch"];
    foreach ($halls as $hall_table) {
        // number of events of all days
        $events = array();
        // all dates with bookings
        $dates_u = array();

        fwrite($sql_file, "\n-- !!!! $hall_table !!!!\n");
        // select all dates with bookings
        $dates_query = "SELECT DISTINCT date FROM $hall_table ORDER BY date";
        $result = mysqli_query($link, $dates_query);
        if (!$result) { exit("Failed to fetch:<br>" . mysqli_error($link)); }
        $dates = array();
        while($row = mysqli_fetch_assoc($result)) { $dates[] = $row; }
        foreach ($dates as $c) { $dates_u[] = $c['date']; }

        // fetch number of bookings for each date        
        foreach ($dates_u as $d) {
            set_time_limit(300);
            $bookings_query = "SELECT * FROM $hall_table WHERE date='$d' ORDER BY date";
            $result = mysqli_query($link, $bookings_query);
            if (!$result) { exit("Failed to fetch:<br>" . mysqli_error($link)); }
            $bookings = array();
            while($row = mysqli_fetch_assoc($result)) { $bookings[] = $row; }
            $bno = mysqli_num_rows($result);
            $events[] = array("date"=>$d, 'no'=>$bno);
        }

        foreach ($events as $event) {
            $insert_query = "    INSERT INTO event_index (date, no, hall) VALUES (" . "'" . $event['date'] . "'," .  $event['no']. ", '$hall_table')";
            fwrite($sql_file, $insert_query . ";\n");
        }
        sleep(5);
    }       
    fclose($sql_file);
?>