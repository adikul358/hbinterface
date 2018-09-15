<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hall Booking Interface - Shiv Nadar School, Noida</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="cal/css/responsive-calendar.css" rel="stylesheet">
    <?php 
        require 'php/conn.php'; 
        require 'php/functions.php'; 
        
        // reset submitted status
        $_SESSION['query_status'] = false;
    
        // number of events of all days
        $events = array();
        // all dates with bookings
        $dates_u = array();
        
        // set hall-to-be-booked
        $hall = "Wild Cats Hall";
        if (isset($_SESSION['hall'])) { 
            $hall = $_SESSION['hall']; 
        }
        $_SESSION['hall'] = $hall;
        
        $_SESSION['date'] = new DateTime("today");
        $_SESSION['date'] = $_SESSION['date']->format("Y-m-d");

        // array for dropdown hall list
        $active = array("WCH"=>"", "CONR"=>"", "MEER"=>"", "GYM"=>"", "COTEL"=>"", "SENL"=>"");
        // function to make selected hall active in dropdown
        hall_active();

        // select all dates with bookings
        $dates_query = "SELECT DISTINCT date FROM " . $hall_table . " ORDER BY date";
        $result = mysqli_query($link, $dates_query);
        if (!$result) { exit("Failed to fetch:<br>" . mysqli_error($link)); }
        $dates = array();
        while($row = mysqli_fetch_assoc($result)) { $dates[] = $row; }
        foreach ($dates as $c) { $dates_u[] = $c['date']; }

        // fetch number of bookings for each date        
        foreach ($dates_u as $d) {
            $bookings_query = "SELECT * FROM " . $hall_table . " WHERE date='$d' ORDER BY date";
            $result = mysqli_query($link, $bookings_query);
            if (!$result) { exit("Failed to fetch:<br>" . mysqli_error($link)); }
            $bookings = array();
            while($row = mysqli_fetch_assoc($result)) { $bookings[] = $row; }
            $bno = mysqli_num_rows($result);
            $events[] = array("date"=>$d, 'no'=>$bno);
        }
    ?>
    <?php echo $_SESSION['badge_styles'] ?>
</head>

<body>

<!-- Main Calendar -->
<div class="card">
    <div class="card-body text-center ">
        <h4 class=card-title>
            <?php echo $hall?>
        </h4>
        <div class="responsive-calendar">
            <div class="controls">
                <div class="flex-center justify-content-center">
                    <div style="width:100%" class="row">
                        <div class="col-xs-auto">
                            <a class=float-left data-go="prev">
                                <div class="btn btn-primary" style=border-radius:50px>Prev</div>
                            </a>
                        </div>
                        <div class="col" style=margin:auto;height:100%text-align:center>
                            <div style=color:black;box-shadow:none;>
                                <h5 style=margin:0>
                                    <span data-head-month></span> - <span data-head-year></span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-xs-auto">
                            <a class=float-right data-go="next">
                                <div class="btn btn-primary" style=border-radius:50px>Next</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="day-headers">
                <div class="day header">Mon</div>
                <div class="day header">Tue</div>
                <div class="day header">Wed</div>
                <div class="day header">Thu</div>
                <div class="day header">Fri</div>
                <div class="day header">Sat</div>
                <div class="day header">Sun</div>
            </div>
            <div class="days" data-group="days">

            </div>
        </div>
    </div>
</div>
<!-- Main Calendar -->

<script src="cal/js/jquery.js"></script>
<script src="cal/js/responsive-calendar.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript">
    // Add Badges to Days
    var removeSlot;
    $.ajax(
        "../php/ajax/get_last_slot.php"
    ).done(function (data) {
        removeSlot = data;
        console.log(data);
        $(".responsive-calendar").responsiveCalendar({
            events: {
                <?php foreach ($events as $curr) { echo '"' . $curr['date'] . '": {"number":' . $curr['no'] . '},'; } ?>
            }
        });
    });
</script>

</body>

</html>