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

                    <h4 class="card-title">August 2018</h4>
                    <div class="btn-group " style="margin-right: 25px" role="group">
                        <button type="button" class="btn btn-primary">
                            <img height=20 src="Java-Calendar/arrows/left_double.svg">
                        </button>

                        <button type="button" class="btn btn-primary">
                            <img src="Java-Calendar/arrows/left_single.svg" height=20>
                        </button>

                    </div>
                    <div class="btn-group " role="group">

                        <button type="button" class="btn btn-primary">
                            <img height=20 src="Java-Calendar/arrows/right_single.svg">
                        </button>
                        <button type="button" class="btn btn-primary">
                            <img height=20 src="Java-Calendar/arrows/right_double.svg">
                        </button>

                    </div>

                </div>

            </div>
        </div>
        <div id="divcalendartable"></div>
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