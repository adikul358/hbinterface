<!DOCTYPE html>
<html>

<head>
    <title>Hall Booking Interface - Shiv Nadar School, Noida</title>
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
        
        $hall_table = "";
        $hall = $_SESSION['hall'];
        $active = array("WCH"=>"", "CONR"=>"", "MEER"=>"", "GYM"=>"", "COTEL"=>"", "SENL"=>"");

        hall();

        $date = $_GET['date'];

        $bookings_query = "SELECT * FROM $hall_table WHERE date='$date' ORDER BY date";
        $result = mysqli_query($link, $bookings_query);
            
        if (!$result) {
          exit("Failed to fetch:<br>" . mysqli_error($link));
        }
            
        $bookings = array();
        while($row = mysqli_fetch_assoc($result)) {
            $bookings[] = $row;
        }

    ?>
</head>

<body style="min-height: 100vh; overflow-x: hidden;background-image: url('images/tuscany-wallpaper-3840x2160-4k-hd-wallpaper-italy-meadows-hills-pines-trees-4886.jpg'); background-repeat: no-repeat; background-position: center;background-size: cover;">

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

    <br>

    <div class="row justify-content-center">
        <div class="col-sm-7">
            <div class="card" style="background:rgba(255,255,255, 0.7)">
                <div class="card-body">
                    <div class="container text-center">
                        <h4 class=card-title>
                            <?php echo $hall?>
                        </h4>
                        <h6>Add New Event for
                            <?php echo date("j F\, Y", strtotime($date))?>
                        </h6>
                    </div>
                    <br>
                    <div class=container>
                        <form id=booking-form method=POST action="" style="width: 80%; margin:auto">
                            <h5>Event Details</h5>
                            <div class="form-group">
                                <label>Event Name</label>
                                <input type="text" name=event class="form-control">
                            </div>
                            <div class=form-group>
                                <label>Available Slots</label>
                                <?php time_slots_display();?>
                        </div>
                            <br>
                            <h5>Contact Details</h5>
                            <div class="form-group">
                                <label>Booking Person</label>
                                <input type="text" name=name class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name=email class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name=phone class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center float-right">
                                <input type=submit name=submit class="btn btn-primary" value="Book Event">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <br>    

    <?php 
        if (isset($_POST['submit'])) {
            $form_data = array();
            $form_data['table'] = $hall_table;
            $form_data['event'] = $_POST['event'];
            $form_data['name'] = $_POST['name'];
            $form_data['date'] = $date;
            $form_data['email'] = $_POST['email'];
            $form_data['phone'] = $_POST['phone'];
            $form_data['slots'] = $_POST['slots'];

            book_event($form_data);
        }
    ?>

    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>

</body>

</html>