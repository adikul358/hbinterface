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
    <link href="css/badge.css" rel="stylesheet">
    <link href="cal/css/responsive-calendar.css" rel="stylesheet">
    <?php 
        require 'php/conn.php'; 
        require 'php/functions.php'; 
        echo set_colors();
        
        // reset submitted status
        $_SESSION['query_status'] = false;
    
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

    ?>
</head>

<body style="width:100vw; overflow-x:hidden; min-height:100vh;">
    <!-- Navbar -->
    <?php require "navbar.html"?>
    <!-- Navbar -->

    <br>

    <!-- Main Calendar -->
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="wch-tab" data-toggle="tab" href="#wch" role="tab"
                            aria-controls="wch" aria-selected="true">Wild Cats Hall</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="conr-tab" data-toggle="tab" href="#conr" role="tab" aria-controls="conr"
                            aria-selected="false">Conference Room</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="cotel-tab" data-toggle="tab" href="#cotel" role="tab" aria-controls="cotel"
                            aria-selected="false">Composite Lab</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="gym-tab" data-toggle="tab" href="#gym" role="tab"
                            aria-controls="gym" aria-selected="false">Gymnasium</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="meer-tab" data-toggle="tab" href="#meer" role="tab" aria-controls="meer"
                            aria-selected="false">Meeting Room</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="senl-tab" data-toggle="tab" href="#senl" role="tab" aria-controls="senl"
                            aria-selected="false">Senior Library</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="wch" role="tabpanel" aria-labelledby="wch-tab">
                        <div class="card-body text-center ">
                            <h4 class=card-title>Wild Cats Hall</h4>
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

                    <div class="tab-pane fade" id="conr" role="tabpanel" aria-labelledby="conr-tab">
                        <div class="card-body text-center ">
                            <h4 class=card-title>Conference Room</h4>
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

                    <div class="tab-pane fade" id="cotel" role="tabpanel" aria-labelledby="cotel-tab">
                        <div class="card-body text-center ">
                            <h4 class=card-title>Composite Lab</h4>
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

                    <div class="tab-pane fade" id="gym" role="tabpanel" aria-labelledby="gym-tab">
                        <div class="card-body text-center ">
                            <h4 class=card-title>Gymnasium</h4>
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

                    <div class="tab-pane fade" id="meer" role="tabpanel" aria-labelledby="meer-tab">
                        <div class="card-body text-center ">
                            <h4 class=card-title>Meeting Room</h4>
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

                    <div class="tab-pane fade" id="senl" role="tabpanel" aria-labelledby="senl-tab">
                        <div class="card-body text-center ">
                            <h4 class=card-title>Senior Library</h4>
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
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Main Calendar -->

    <br>

    <script src="cal/js/jquery.js"></script>
    <script src="cal/js/responsive-calendar.js"></script>

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
                }
            });
        });

    </script>

    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script>
        var x = window.matchMedia("(max-width: 982px)");
        justifyTabs(x);
        x.addListener(justifyTabs);
    </script>

</body>

</html>