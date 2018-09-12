<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Hall Booking Interface - Shiv Nadar School, Noida</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/mdb.min.css" rel="stylesheet">
    <link href="../cal/css/responsive-calendar.css" rel="stylesheet">
    <?php 
        // require 'php/conn.php'; 
        require '../php/conn.php'; 
        require '../php/functions.php'; 
        
        // reset submitted status
        $_SESSION['query_status'] = false;
        
        $hall = $_SESSION['hall'];
        // array for dropdown hall list
        $active = array("WCH"=>"", "CONR"=>"", "MEER"=>"", "GYM"=>"", "COTEL"=>"", "SENL"=>"");
        // function to make selected hall active in dropdown
        hall_active();

        $date = $_SESSION['date'];

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

<body style="overflow-x:hidden; min-height:100vh;">
    <div class=container-fluid style=padding:0>
        <nav class="navbar whitenavbar-expand-lg navbar-light sticky-top">

            <a class="navbar-brand" href="/">
                <img src="../images/SNS_Logo.png" id=header-logo style="padding:2px; margin-right: 5px; border-right: 1px solid black; padding-right: 10px;"
                    height="30" class="d-inline-block align-top" alt=""> Hall Booking Interface
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
                            <a class="dropdown-item <?php echo $active['WCH']?>" href="/">Wild Cats Hall</a>
                            <a class="dropdown-item <?php echo $active['CONR']?>" href="/?hall=Conference Room">Conference
                                Room</a>
                            <a class="dropdown-item <?php echo $active['MEER']?>" href="/?hall=Meeting Room">Meeting
                                Room</a>
                            <a class="dropdown-item <?php echo $active['GYM']?>" href="/?hall=Gymnasium">Gymnasium</a>
                            <a class="dropdown-item <?php echo $active['COTEL']?>" href="/?hall=Composite Lab">Composite
                                Lab</a>
                            <a class="dropdown-item <?php echo $active['SENL']?>" href="/?hall=Senior Library">Senior
                                Library</a>
                        </div>
                    </li>

                </ul>

            </div>
        </nav>
    </div>
    <br>

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h4 class=card-title>
                            <?php echo $hall?>
                        </h4>
                        <h6>Add New Event for
                            <?php echo date("j F\, Y", strtotime($date))?>
                        </h6>
                    </div>
                    <br>
                    <div class=container>
                        <form class="needs-validation" novalidate id=booking-form method=POST action="" style="width: 100%; margin:auto">
                            <h5 style="border-bottom:2.5px solid #ced4da;">Event Details</h5>
                            <div class="form-group">
                                <label for="validationEventName">Event Name</label>
                                <input id="validationEventName" required placeholder="Event Name" type="text" name=event class="form-control">
                                <div class="invalid-feedback">Please Enter an Event Name</div>
                                </div>
                            <div class=form-group>
                                <label for=slots[]>Available Slots</label>
                                <?php time_slots_display(date("Y-m-d", strtotime($date)));?>
                                
                            </div>
                            <br>
                            <h5 style="border-bottom:2.5px solid #ced4da;">Contact Details</h5>
                            <div class="form-group">
                                <label for="validateName">Name</label>
                                <input required id=validateName type="text" name=name class="form-control">
                                <div class="invalid-feedback">Please Enter Your Name</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validateEmail">Email</label>
                                        <input required id=validateEmail type="email" name=email class="form-control">
                                        <div class="invalid-feedback">Please Enter Your Email</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validatePhone">Phone</label>
                                        <input onkeypress="return AllowNumbersOnly(event)" required id=validatePhone type="text" minlength="10" maxlength="10" name=phone class="form-control">
                                        <div class="invalid-feedback">Please Enter Your 10-digit Phone No.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center float-right">
                                <button type=submit name=submit class="btn btn-primary">Book Event</button>
                            </div>
                        </form>
                        <br><br>
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

    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/mdb.min.js"></script>

    <script>
        // not allowing text input in phone field
        function AllowNumbersOnly(e) {
            var charCode = (e.which) ? e.which : e.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                e.preventDefault();
            }
        }

        // stoping validation
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        var checked = $(".needs-validation input:checked").length > 0;
                        if (!checked) {
                            $(".slots").prop('required', true);
                        } else {
                            $(".slots").prop('required', false);
                        }
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

</body>

</html>