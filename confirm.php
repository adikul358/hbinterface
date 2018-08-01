<!DOCTYPE html>
<html>
<head>
    <script src="main.js"></script>
    <?php 
        
        session_start();
        require "connect.php";
        
        $respond = 'confirm';
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $event = mysqli_real_escape_string($link, $_POST['event']);
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $date = $_SESSION['date'];
        
        $event_query = "INSERT INTO bookings (event, date, start, end, name, phone, email)
        VALUES ('$event', '$date', '$start', '$end', '$name', '$phone', '$email')";
        $eresult = mysqli_query($link, $event_query);
        if(!$eresult) {
            $respond = 'err';
        }

    ?>
<title>Page Title</title>
</head>
<body>
<div class="header">
		<div id="title">
			<a href="index.php" style="text-decoration: none">
				<h1>WCH Booking Interface</h1>
			</a>
		</div>
		<img src="images\SNS_Logo.png" alt="Shiv Nadar School logo" id="schlo">

	</div>
</body>
</html>