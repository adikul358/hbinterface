<!DOCTYPE html>
<html>
    
    <head>
        <title>WCH Booking Interface - Shiv Nadar School, Noida</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="css/mdb.min.css" rel="stylesheet">
        <!-- Your custom styles (optional) -->
        <link href="css/style.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Economica' rel='stylesheet' type='text/css'>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
        <!-- Respomsive slider -->
        <link href="calendar 0.9/css/responsive-calendar.css" rel="stylesheet">
</head>

<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light primary-color-light">

        <!-- Navbar brand -->
        <a class="navbar-brand" href="#">
            <img src="images/SNS_Logo.png" style="padding:2px; margin-right: 5px; border-right: 1px solid black; padding-right: 10px;"
                height="30" class="d-inline-block align-top" alt=""> Hall Booking Interface
        </a>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Book an Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">See Bookings</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Halls</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Wild Cats Hall</a>
                        <a class="dropdown-item" href="#">Conference Room</a>
                        <a class="dropdown-item" href="#">Meeting Room</a>
                        <a class="dropdown-item" href="#">Gymnasium</a>
                        <a class="dropdown-item" href="#">Composite Lab</a>
                        <a class="dropdown-item" href="#">Senior Library</a>
                    </div>
                </li>

            </ul>

        </div>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card ">
                <div class="card-body text-center ">

                    <h4 id=monthandyearspan class="card-title">August 2018</h4>
                    <div class="btn-group " style="margin-right: 25px" role="group">
                        <button type="button" class="btn btn-primary-light">
                            <img height=20 src="Java-Calendar/arrows/left_double.svg">
                        </button>

                        <button type="button" class="btn btn-primary-light">
                            <img src="Java-Calendar/arrows/left_single.svg" height=20>
                        </button>

                    </div>
                    <div class="btn-group " role="group">

                        <button type="button" class="btn btn-primary-light">
                            <img height=20 src="Java-Calendar/arrows/right_single.svg">
                        </button>
                        <button type="button" class="btn btn-primary-light">
                            <img height=20 src="Java-Calendar/arrows/right_double.svg">
                        </button>

                    </div>

                </div>

            </div>
        </div>
    <div class="container">
      <!-- Responsive calendar - START -->
    	<div class="responsive-calendar">
        <div class="controls">
            <a class="pull-left" data-go="prev"><div class="btn btn-primary">Prev</div></a>
            <h4><span data-head-year></span> <span data-head-month></span></h4>
            <a class="pull-right" data-go="next"><div class="btn btn-primary">Next</div></a>
        </div><hr/>
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
      <!-- Responsive calendar - END -->
    </div>
    <script src="calendar 0.9/js/jquery.js"></script>
    <script src="calendar 0.9/js/bootstrap.min.js"></script>
    <script src="calendar 0.9/js/responsive-calendar.js"></script>
    <script type="text/javascript">


      $(document).ready(function () {
        $(".responsive-calendar").responsiveCalendar({
          time: "2018-08",
          events: {
            "2013-04-30": {"number": 5, "url": "http://w3widgets.com/responsive-slider"},
            "2013-04-26": {"number": 1, "url": "http://w3widgets.com"}, 
            "2013-05-03":{"number": 1}, 
            "2013-06-12": {}}
        });
      });
    </script>
        </div>
    </div>


    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="Java-Calendar/main.js"></script>

</body>

</html>