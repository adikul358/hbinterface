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
    
    function time_slots_display() {
        global $bookings;
        $counter = 1;
        $html = "";
        $slts = array("9:00 AM - 10:10 AM",
                    "10:10 AM - 11:20 AM",
                    "11:20 AM - 12:30 PM",
                    "12:30 PM - 1:40 PM",
                    "2:10 PM - 3:20 PM");
        $used_slts = array();
        $avail_slts = array();
        $ava_slts = array();
        
        foreach ($bookings as $slt) {
            $used_slts[] = ($slt['slot_no'] >  0) ? $slts[$slt['slot_no']-1] : "";
        }
        $ava_slts = array_diff($slts, $used_slts);
        
        foreach ($ava_slts as $v)  {
            $avail_slts[] = $v;
        }
        
        foreach ($avail_slts as $slt) {
            $html = '<div class="custom-control custom-checkbox" style=margin-bottom:5px>
            <input type="checkbox" class="custom-control-input" id=timeslot';
            $html .= $counter;
            $html .= '><label class="custom-control-label" for=timeslot';
            $html .= $counter;
            $html .= '>';
            $html .= $slt;
            $html .= '</label></div>';
            echo $html;
            $counter++;
        }
    }
?>