<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <title>View Events - Hall Booking Interface @SNSN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/mdb.min.css" rel="stylesheet">
    <link href="../cal/css/responsive-calendar.css" rel="stylesheet">
    <?php 
        require '../php/conn.php'; 
        require '../php/functions.php';

        $date = strtotime($_SESSION['date']);
        
    ?>
    <?php
        $button_status = array();
        $event_status = array();
        
        $button_status['color'] = "btn-primary";
        $button_status['link'] = "onclick=location.href='/book/'";
        $button_status['text'] = "Book New Event";
        $button_status['len'] = "7";
        $button_status['icon'] = "fa-plus";

        // if (mysqli_num_rows($result)) {
        //     $event_status[0] = "";
        //     $event_status[1] = mysqli_num_rows($result) . " Slots Booked";
        //     $event_status[2] = "<br>";
        //     $event_status[3] = "";
        //     if (mysqli_num_rows($result) == 1) {
        //         $event_status[1] = mysqli_num_rows($result) . " Slot Booked";
        //     }
        //     if (mysqli_num_rows($result) >= count($total_slts)) {
        //         $button_status['color'] = "btn-blue-grey";
        //         $button_status['link'] = "";
        //         $button_status['text'] = "No More Slots Available";
        //         $button_status['len'] = "12";
        //         $button_status['icon'] = "fa-times";
        //     }
        // } else {
            $event_status[0] = "style=display:none";
            $event_status[1] = "No Events Booked";
            $event_status[2] = "";
            $event_status[3] = "<br>";
        // }

        if ($date == strtotime("today")) {
            $prev_disable = true;
        } else {
            $prev_disable = false;
        }
        
        $pd = array("onclick=prevSessionDate('" . $_SESSION['date'] . "')",  "");
        if ($prev_disable) {
            $pd = array("style=cursor:default", "disabled");
        }

    ?>
</head>

<body style="overflow-x:hidden; min-height:100vh;">

    <?php require "../navbar.html";?>
    <br>

    <!-- Main Card -->
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body text-center">
                    <div class=container>
                        <h4 class=card-title>Wild Cats Hall</h4>
                        <div class="controls" style=width:100%>
                            <a href="/">
                                <h6 style=margin:0;letter-spacing:4px>
                                    <?php echo date("j F\, Y", $date)?>
                                </h6>
                            </a>
                            <div id="controls_main" class="flex-center justify-content-center">
                                <div style="width:100%" class="row">
                                    <div class="col-xs-auto">
                                        <a class=float-left id="prevd" <?php echo $pd[0]?>>
                                            <div style=border-radius:50px class="<?php echo $pd[1]?> btn btn-primary">Prev</div>
                                        </a>
                                    </div>
                                    <div class="col" style=margin:auto;height:100%text-align:center>
                                        <div style=color:black;box-shadow:none;>
                                            <h6 style=margin:0>
                                                <?php echo $event_status[1]?>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="col-xs-auto">
                                        <a class=float-right id="nextn">
                                            <div style=border-radius:50px class="btn btn-primary" onclick=nextSessionDate(<?php echo "'" . $_SESSION['date'] . "'"?>)>Next</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <!-- Main Card -->

    <br>

    <style>
        #float:hover span {
            max-width: <?php echo $button_status['len']?>rem;
        }
    </style>

    <!-- add button -->
    <div class=fixed-button>
        <button id=float type=button class="btn <?php echo $button_status['color']?>" <?php echo
            $button_status['link']?>>
            <i class="fa <?php echo $button_status['icon']?>" id=pen></i><span>
                <?php echo $button_status['text']?></span>
        </button>
    </div>

    <!-- successfully booked modal -->
    <div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
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
    <!-- successfully booked modal -->

    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../cal/js/responsive-calendar.js"></script>
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/mdb.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>

    <?php 
        if ($_SESSION['query_status'] == true) {
            echo "<script>$('#centralModalSuccess').modal('show');</script>";
        }
        $_SESSION['query_status'] = false;
        ?>

</body>

</html>