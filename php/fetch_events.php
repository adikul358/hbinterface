<?php 
    $sql ="";

    $halls = ["conr", "cotel", "gym", "meer", "senl", "wch"];
    foreach ($halls as $hall) {
        $sql .= "SELECT * FROM event_index WHERE hall='$hall' ORDER BY date;";
    }

    if (mysqli_multi_query($link, $sql)) {
        do {
            /* store first result set */
            if ($result = mysqli_store_result($link)) {
                while ($row = mysqli_fetch_array($result)) {
                    $array = $row['hall'];
                    $$array[$row['date']] = $row['no'];
                }
                mysqli_free_result($result);
            } else {
                echo mysqli_error($link);
            }
        } 
        while (mysqli_next_result($link));
    } else {
        echo mysqli_error($link);
    }

?>