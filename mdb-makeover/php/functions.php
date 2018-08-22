<?php
    function hall() {
        global $hall;
        global $hall_table;
        global $active;

            switch ($hall) {
                case 'Wild Cats Hall':
                    foreach ($active as $key => $ac) {
                        if ($key === "WCH") {
                            $active[$key] = "active";
                        }
                    }
                    $hall_table = "wch";
                    break;
                case 'Conference Room':
                    foreach ($active as $key => $ac) {
                        if ($key === "CONR") {
                            $active[$key] = "active";
                        }
                    }
                    $hall_table = "conr";
                    break;
                case 'Meeting Room':
                    foreach ($active as $key => $ac) {
                        if ($key === "MEER") {
                            $active[$key] = "active";
                        }
                    }
                    $hall_table = "meer";
                    break;
                case 'Gymnasium':
                    foreach ($active as $key => $ac) {
                        if ($key === "GYM") {
                            $active[$key] = "active";
                        }
                    }
                    $hall_table = "gym";
                    break;
                case 'Composite Lab':
                    foreach ($active as $key => $ac) {
                        if ($key === "COTEL") {
                            $active[$key] = "active";
                        }
                    }
                    $hall_table = "cotel";
                    break;
                case 'Senior Library':
                    foreach ($active as $key => $ac) {
                        if ($key === "SENL") {
                            $active[$key] = "active";
                        }
                    }
                    $hall_table = "senl";
                    break;
            }
    }

    function event_display() {
        global $bookings;
        $counter = 1;
        $html = "";
        
        foreach ($bookings as $eve) {
            $html = "<tr><th scope='row'>";
            $html .= $counter;
            $html .= "</th><td>";
            $html .= $eve['event'];
            $html .= "</td><td>";
            $html .= $eve['start'];
            $html .= "</td><td>";
            $html .= $eve['end'];
            $html .= "</td><td>";
            $html .= $eve['name'];
            $html .= "</td><td>";
            $html .= $eve['email'];
            $html .= "</td><td>";
            $html .= $eve['phone'];
            $html .= "</td></tr>";
            echo $html;
            $counter++;
        }
    
    }
?>