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
    ?>

    <?php echo $_SESSION['badge_styles'] ?>
</head>

<body style="width:100vw; overflow:hidden; min-height:100vh;">
    <div id=loading-overlay style="height:100vh; z-index:1" class="flex-center flex-column container-fluid white">
        <div id=image class="text-center">
            <img style="height:80px" class=img-fluid src="/images/buffer-3.gif">
            <br>
            <br>
            <h1 class=h3-responsive>Hall Booking Interface</h1>
        </div>
    </div>
    <!-- Navbar -->
    <div id=top-nav class=container-fluid style=padding:0>
        <nav class="navbar white navbar-expand-lg navbar-light sticky-top">
        <a class="navbar-brand" href="/">
                <img src="images/SNS_Logo.png" id=header-logo height="30" class="align-top" alt=""> Hall Booking Interface
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="basicExampleNav">

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Halls</a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item <?php echo $active['WCH']?>" onclick="setSessionHall('Wild Cats Hall','false')">Wild Cats Hall</a>
                            <a class="dropdown-item <?php echo $active['CONR']?>" onclick="setSessionHall('Conference Room','false')">Conference Room</a>
                            <a class="dropdown-item <?php echo $active['MEER']?>" onclick="setSessionHall('Meeting Room','false')">Meeting Room</a>
                            <a class="dropdown-item <?php echo $active['GYM']?>" onclick="setSessionHall('Gymnasium','false')">Gymnasium</a>
                            <a class="dropdown-item <?php echo $active['COTEL']?>" onclick="setSessionHall('Composite Lab','false')">Composite Lab</a>
                            <a class="dropdown-item <?php echo $active['SENL']?>" onclick="setSessionHall('Senior Library','false')">Senior Library</a>
                        </div>
                    </li>

                </ul>

            </div>
        </nav>
    </div>
    <!-- Navbar -->

    <br>

    <!-- Main Calendar -->
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card">
            </div>
        </div>
    </div>
    <!-- Main Calendar -->

    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script>
        $(document).ready(function () {
            $('.card').load("/calendar.php", function () {
                setInterval(function () {
                    $("#loading-overlay").slideUp("slow")
                }, 500);
            })
        });
    </script>

</body>

</html>