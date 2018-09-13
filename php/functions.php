<?php
    
    require "conn.php";
    date_default_timezone_set("Asia/Kolkata");
    
    // fetch color array from strangeplanet.fr
    function set_colors($steps) {
        $url="https://www.strangeplanet.fr/work/gradient-generator/?c=" . $steps . ":007E33:ff8800:C62828";
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        // $html = curl_exec($ch);
        // curl_close($ch);
        // echo "<br>";
        print_r($url);
        echo "<br>";
        libxml_use_internal_errors(true);
        $doc = new DOMDocument;
        $doc->loadHTMLFile($url);
        $xpath = new DOMXpath($doc);
        $node = $xpath->query('//textarea[@cols="80"]')->item(0);
        print_r("node: " + $node);
        echo "<br>";
        
        $textContent = $node->textContent;
        print_r($textContent);
        echo "<br>";
        $textContent = explode(");", explode("array(", explode(" = ", $textContent)[1])[1])[0];
        print_r($textContent);
        echo "<br>";
        $textContent = str_replace('"', "", $textContent);
        print_r($textContent);
        echo "<br>";
        $gradient = explode(",", $textContent);
        print_r($gradient);
        echo "<br>";
    
        $i = 0;
        $css = "<style>\r\n\r\n/*$steps*/\r\n\r\n";
        foreach ($gradient as $clr) {
            global $i;
            $i++;
            $css .= ".badge-" . $i . " {background-color: #" . $clr . " !important}\r\n";
        }
        $css .= "\r\n/*$steps*/\r\n\r\n</style>";
        // if (is_dir("css")) {
        //     $css_file = fopen("css/badge.css", "w");
        //     fwrite($css_file, $css);
        // }
        $_SESSION['badge_styles'] = $css;
    };

    // make time slots
    function make_slots($start_time, $end_time, $gap) {
        global $total_slts;
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        $gap_i = "+" . $gap . " minutes";
        $curr_start_time = $curr_end_time = strtotime("00:00:00");
        $total_slts = array();
        $i = 0;

        do {
            $offset = "+" . $gap*$i . " minutes";
            $curr_start_time = strtotime($offset, $start_time);
            $curr_end_time = strtotime($gap_i, $curr_start_time);
            $input = date("H:i:s", $curr_start_time) . " - " . date("H:i:s", $curr_end_time);
            $total_slts[] = $input;
            $i++;
        } while (strtotime($gap_i, $curr_end_time) < $end_time);

        set_colors($i);
    }
    
    make_slots("08:00:00", "18:00:00", 60);

    // make selected hall active in dropdown
    function hall_active() {
        global $hall;
        global $hall_table;
        global $active;

        switch ($hall) {
            case 'Wild Cats Hall':
            foreach ($active as $key => $ac) {
                if ($key === "WCH") { $active[$key] = "active"; }
            }
            $hall_table = "wch";
            break;

            case 'Conference Room':
            foreach ($active as $key => $ac) { 
                if ($key === "CONR") { $active[$key] = "active"; }
            }
            $hall_table = "conr";
            break;

            case 'Meeting Room':
            foreach ($active as $key => $ac) {
                if ($key === "MEER") { $active[$key] = "active"; }
            }
            $hall_table = "meer";
            break;

            case 'Gymnasium':
            foreach ($active as $key => $ac) {
                if ($key === "GYM") { $active[$key] = "active"; }
            }
            $hall_table = "gym";
            break;

            case 'Composite Lab':
            foreach ($active as $key => $ac) {
                if ($key === "COTEL") { $active[$key] = "active"; }
            }
            $hall_table = "cotel";
            break;

            case 'Senior Library':
            foreach ($active as $key => $ac) {
                if ($key === "SENL") { $active[$key] = "active"; }
            }
            $hall_table = "senl";
            break;
        }
    }

    // go to next date
    function next_date($date) {
        return strtotime("+1 day", $date);
    }

    // go to prev date
    function prev_date($date) {
        return strtotime("-1 day", $date);
    }
    
    // preview all events of selected date
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
    
    // display all time slots for checkbox selection
    function time_slots_display($date, $print) {
        global $total_slts; 
        global $bookings;
        $counter = 1;
        $html = "";

        $used_slts = array();
        $avail_slts = array();
        $ava_slts = array();

        // filter out booked slots
        $bookings = array();
        foreach ($bookings as $slt) {
            $used_slts[] = ($slt['slot_no'] >  0) ? $total_slts[$slt['slot_no']-1] : "";
        }
        
        $ava_slts = array_diff($total_slts, $used_slts);
        
        // filter out out-of-time slots
        $date = explode("-", $date);
        $now  = new DateTime();
        foreach ($ava_slts as $v)  {
            $start = new DateTime(explode(" - ", $v)[0]);
            $start->setDate($date[0], $date[1], $date[2]);
            if ($start > $now) { 
                $avail_slts[] = $v;
                global $outdated;
                $outdated = false;
            } else {
                $outdated = true;
            }
        }
        
        if (count($avail_slts) > 0 && $print)
        foreach ($avail_slts as $slt) {
            $s = explode(" - ", $slt);
            $st = date("g:i A", strtotime($s[0])) . " - " . date("g:i A", strtotime($s[1])) ;
            
            $html = '<div class="custom-control custom-checkbox" style=margin-bottom:5px>
            <input type="checkbox" class="slots custom-control-input" name="slots[]" value="';
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
        } elseif (!$print) {
            return $outdated;
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
        echo "<script>window.location.href = '/events/';</script>";
    }   

?>
