<?php
    require "conn.php";

    $total_slts = array("09:00:00 - 10:10:00",
                    "10:10:00 - 11:20:00",
                    "11:20:00 - 12:30:00",
                    "12:30:00 - 13:40:00",
                    "14:10:00 - 15:20:00");

    
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

    function next_link($d,$m,$y) {
        $dn = $d+1; $mn = $m; $yn = $y;

        $last_day = date("d", mktime(0,0,0, $m+1, 0, $y));
        if ($dn > $last_day) {
            $dn = 1;
            $mn++;
            if ($m >= 12) {
                $mn = 1;
                $yn++;
            }
        }
        return "d=" . $dn . "&m=" . $mn . "&y=" . $yn;
    }
    
    function prev_link($d,$m,$y) {
        $dn = $d-1; $mn = $m; $yn = $y;
        
        $last_day = date("d", mktime(0,0,0, $m, 0, $y));
        if ($dn < 1) {
            $dn = $last_day;
            $mn--;
            if ($m <= 1) {
                $mn = 12;
                $yn--;
            }
        }
        return "d=" . $dn . "&m=" . $mn . "&y=" . $yn;
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
            $html .= date("g:i A", strtotime($eve['start']));
            $html .= "</td><td>";
            $html .= date("g:i A", strtotime($eve['end']));
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
    
    function time_slots_display() {
        global $bookings;
        $counter = 1;
        $html = "";
        global $total_slts; 

        $used_slts = array();
        $avail_slts = array();
        $ava_slts = array();
        
        foreach ($bookings as $slt) {
            $used_slts[] = ($slt['slot_no'] >  0) ? $total_slts[$slt['slot_no']-1] : "";
        }
        $ava_slts = array_diff($total_slts, $used_slts);
        
        foreach ($ava_slts as $v)  {
            $avail_slts[] = $v;
        }
        
        foreach ($avail_slts as $slt) {
            $s = explode(" - ", $slt);
            $st = date("g:i A", strtotime($s[0])) . " - " . date("g:i A", strtotime($s[1])) ;
            
            $html = '<div class="custom-control custom-checkbox" style=margin-bottom:5px>
            <input type="checkbox" class="custom-control-input" name="slots[]" value="';
            $html .= $slt;
            $html .= '" id=timeslot';
            $html .= $counter;
            $html .= '><label class="custom-control-label" for=timeslot';
            $html .= $counter;
            $html .= '>';
            $html .= $st;
            $html .= '</label></div>';
            echo $html;
            $counter++;
        }
    }

    function book_event($data) {
        global $link;
        $event = mysqli_real_escape_string($link, $data['event']);
        $date = $data['date'];
        $name = mysqli_real_escape_string($link, $data['name']);
        $email = mysqli_real_escape_string($link, $data['email']);
        $phone = $data['phone'];

        global $total_slts;
        print_r($data['slots']);
        foreach ($data['slots'] as $time) {
            $slot_no = array_search($time, $total_slts);
            $slot_no++;
            
            $time = explode(" - ", $time);
            $start = $time[0];
            $end = $time[1];

            $insert_query = "INSERT INTO " . $data['table'] . " (event, date, start, end, name, email, phone, slot_no)";
            $insert_query .= " VALUES ('$event', '$date', '$start', '$end', '$name', '$email', '$phone', $slot_no)";
            $insert_query .= "; ";

            echo $insert_query;

            $result = mysqli_query($link, $insert_query);

            if (!$result) {die(mysqli_error($link));}
        }
        $link_date = explode("-", $date);
        $link_date = "d=" . $link_date[2] . "&m=" . $link_date[1] . "&y=" . $link_date[0];

        $_SESSION['query_status'] = true;
        echo "<script>window.location.href = 'view_events.php?" . $link_date . "';</script>";
    }   

?>
