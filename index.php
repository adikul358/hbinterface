<!DOCTYPE html>
<html>

<head>
    <title>Hall Booking Interface - Shiv Nadar School, Noida</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="cal/css/responsive-calendar.css" rel="stylesheet">
    <?php 
        require 'php/conn.php'; 
        require 'php/functions.php'; 
        session_start();
        $_SESSION['query_status'] = false;
    
        $events = array();
        $dates_u = array();
        
        $hall_table = "wch";
        $hall = "Wild Cats Hall";
        if (isset($_GET['hall'])) {
            $hall = $_GET['hall'];
            $_SESSION['hall'] = $_GET['hall'];
        }
        $_SESSION['hall'] = $hall;
        $active = array("WCH"=>"", "CONR"=>"", "MEER"=>"", "GYM"=>"", "COTEL"=>"", "SENL"=>"");

        hall();

        $dates_query = "SELECT DISTINCT date FROM " . $hall_table . " ORDER BY date";
        $result = mysqli_query($link, $dates_query);
        
        if (!$result) {
            exit("Failed to fetch:<br>" . mysqli_error($link));
        }
        
        $dates = array();
        while($row = mysqli_fetch_assoc($result)) {
            $dates[] = $row;
        }
        
        foreach ($dates as $c) {
            $dates_u[] = $c['date'];
        }

        foreach ($dates_u as $d) {
            $bookings_query = "SELECT * FROM " . $hall_table . " WHERE date='$d' ORDER BY date";
            $result = mysqli_query($link, $bookings_query);
            
            if (!$result) {
                exit("Failed to fetch:<br>" . mysqli_error($link));
            }
            
            $bookings = array();
            while($row = mysqli_fetch_assoc($result)) {
                $bookings[] = $row;
            }
    
            $bno = mysqli_num_rows($result);
            
            $events[] = array("date"=>$d, 'no'=>$bno);
        }
    ?>
</head>

<body style="overflow-x:hidden; min-height:100vh; background: white; background-repeat: no-repeat; background-position: center;background-size: cover;">
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
        <div class="col-sm-8">
            <div class="card" style="background:rgba(255,255,255, 0.7)">
                <div class="card-body text-center ">
                    <div class=container>
                        <h4 class=card-title>
                            <?php echo $hall?>
                        </h4>
                        <div class="responsive-calendar">
                            <div class="controls">
                                <a class=float-left data-go="prev">
                                    <div class="btn btn-primary">Prev</div>
                                </a>
                                <div class=btn style=color:black;box-shadow:none;>
                                    <h5 style=margin:0>
                                        <span data-head-month></span>
                                        -
                                        <span data-head-year></span>
                                    </h5>
                                </div>
                                <a class=float-right data-go="next">
                                    <div class="btn btn-primary">Next</div>
                                </a>
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
    <br>
    <script src="cal/js/jquery.js"></script>
    <script src="cal/js/responsive-calendar.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".responsive-calendar").responsiveCalendar({
                events: {
                    <?php
                       foreach ($events as $curr) {
                        echo '"' . $curr['date'] . '": {"number":' . $curr['no'] . '},';
                    }
                    ?>

                }
            });
        });
    </script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>

</body>

</html>
