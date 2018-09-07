<?php session_start(); ?>
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
        
    
        $events = array();
        $dates_u = array();
        
        $hall_table = "";
        $hall = $_SESSION['hall'];

        $active = array("WCH"=>"", "CONR"=>"", "MEER"=>"", "GYM"=>"", "COTEL"=>"", "SENL"=>"");

        hall();
        $date = date("Y\-m\-d", mktime(0,0,0,$_GET['m'], $_GET['d'], $_GET['y']));
        $next_link = next_link($_GET['d'], $_GET['m'], $_GET['y']);
        $prev_link = prev_link($_GET['d'], $_GET['m'], $_GET['y']);

        $bookings_query = "SELECT * FROM $hall_table WHERE date='$date' ORDER BY slot_no";
        $result = mysqli_query($link, $bookings_query);
            
        if (!$result) {
          exit("Failed to fetch:<br>" . mysqli_error($link));
        }
            
        $bookings = array();
        while($row = mysqli_fetch_assoc($result)) {
            $bookings[] = $row;
        }

        $event_status = array();
        
        $link_book = "'book.php?date=" . $date . "'";
        $button_status['color'] = "btn-primary";
        $button_status['link'] = "onclick=location.href=" . $link_book;
        $button_status['text'] = "Book New Event";
        $button_status['len'] = "7";
        $button_status['icon'] = "fa-plus";

        if (mysqli_num_rows($result)) {
            $event_status[0] = "";
            $event_status[1] = mysqli_num_rows($result) . " Slots Booked";
            $event_status[2] = "<br>";
            $event_status[3] = "";
            if (mysqli_num_rows($result) == 1) {
                $event_status[1] = mysqli_num_rows($result) . " Slot Booked";
            }

            if (mysqli_num_rows($result) >= count($total_slts)) {
                $button_status['color'] = "btn-blue-grey";
                $button_status['link'] = "";
                $button_status['text'] = "No More Slots Available";
                $button_status['len'] = "12";
                $button_status['icon'] = "fa-times";
            }
        } else {
            $event_status[0] = "style=display:none";
            $event_status[1] = "No Events Booked";
            $event_status[2] = "";
            $event_status[3] = "<br>";
        }

    ?>
</head>

<body style="overflow-x:hidden; min-height:100vh;">
<div  class=container-fluid style=padding:0>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background:rgba(255,255,255, 0.7)">

        <a class="navbar-brand" href="/">
            <img src="images/SNS_Logo.png" style="padding:2px; margin-right: 5px; border-right: 1px solid black; padding-right: 10px;"
                height="30" class="d-inline-block align-top" alt=""> Hall Booking Interface
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="basicExampleNav">

            <ul class="navbar-nav mr-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Halls</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item <?php echo $active['WCH']?>" href="/">Wild Cats Hall</a>
                        <a class="dropdown-item <?php echo $active['CONR']?>" href="index.php?hall=Conference Room">Conference Room</a>
                        <a class="dropdown-item <?php echo $active['MEER']?>" href="index.php?hall=Meeting Room">Meeting Room</a>
                        <a class="dropdown-item <?php echo $active['GYM']?>" href="index.php?hall=Gymnasium">Gymnasium</a>
                        <a class="dropdown-item <?php echo $active['COTEL']?>" href="index.php?hall=Composite Lab">Composite Lab</a>
                        <a class="dropdown-item <?php echo $active['SENL']?>" href="index.php?hall=Senior Library">Senior Library</a>
                    </div>
                </li>

            </ul>

        </div>
    </nav>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-sm-9">
            <div class="card" style="background:rgba(255,255,255, 0.7)">
                <div class="card-body text-center ">
                    <div class=container>
                            <h4 class=card-title>
                                <?php echo $hall?>
                            </h4>
                        <div class="controls">
                            <a class=float-left id="prevd"  href=view_events.php?<?php echo $prev_link?>>
                                <div class="btn btn-primary">Prev</div>
                            </a>
                            <div class=btn style=color:black;box-shadow:none;>
                            <h6 style=margin:0>
                                <?php echo $event_status[1]?>
                            </h6>
                            </div>
                            <a class=float-right id="nextn" href=view_events.php?<?php echo $next_link?>>
                                <div class="btn btn-primary">Next</div>
                            </a>
                        </div>
                            <h6 style=margin:0;letter-spacing:4px>
                                <?php echo date("j F\, Y", strtotime($date))?>
                            </h6>
                        <?php echo $event_status[3]?>
                        <script>
                        </script>
                        <?php echo $event_status[2]?>
                        <div class=table-responsive <?php echo $event_status[0]?>>
                            <table id="tablePreview" class="table">
                                <thead style="background: rgb(66,133,244); color: white;">
                                    <tr>
                                        <th>S no.</th>
                                        <th>Event</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Booked by</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php event_display()?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <style>
        #float:hover span {
            max-width: <?php echo $button_status['len']?>rem;
        }
    </style>
    <div class=fixed-button>
        <button id=float type=button class="btn <?php echo $button_status['color']?>" <?php echo $button_status['link']?>>
            <i class="fa <?php echo $button_status['icon']?>" id=pen></i><span><?php echo $button_status['text']?></span>
        </button>
    </div>

    <div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="heading lead">Event Successfully Added</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <i class="fa fa-check fa-4x mb-3 animated rotateIn"></i>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>

    <?php 
        if ($_SESSION['query_status'] == true) {
            echo "<script>$('#centralModalSuccess').modal('show');</script>";
        }
        $_SESSION['query_status'] = false;
        ?>

</body>

</html>