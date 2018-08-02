<!DOCTYPE html>
<html>
<head>
    <link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="Java-Calendar/main.css">
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
        $startd = date("h:i A", strtotime($_POST['start']));
        $endd = date("h:i A", strtotime($_POST['end']));
		$date = $_SESSION['date'];
		
        $event_query = "INSERT INTO bookings (event, date, start, end, name, phone, email)
        VALUES ('$event', '$date', '$start', '$end', '$name', '$phone', '$email')";
        $eresult = mysqli_query($link, $event_query);
        if(!$eresult) {
            $respond = 'err';
        }

        $ds = array();
        $ds = explode("-", $date);

        $mp = (int)$ds[1];
        $mp--;
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
    <div id=cntnt>
    <div id="titlespan" style="display: block; border-bottom: 2px solid black; width: 80%;">
        Slot Booked Successfully</div>
    </div>
    <div id=mbfc>
        <form method=POST action="<?php echo 'book.php?d=' . $ds[2] . "&m=" . $mp . "&y=" . $ds[0]?>">
					<div id="form">

						<label>Event Name</label>
						<br>
						<input type=text name="event" readonly value="<?php echo $event?>">
						<br>
						<br>

						<div id="times">
							
							<div style="width: 50%; float: left">
								<label>Start Time</label>
								<br>
								<input type=text name="start" id=s readonly value="<?php echo $startd?>">
								</select>
								<br>
							</div>
							
							<div>
								<label>End Time</label>
								<br>    
								<input type=text name="end" id=e readonly value="<?php echo $endd?>">
								</select>
								<br>
							</div>
							
							<br>
							<br>
							<label>Name of Person Booking</label>
							<br>
							<input type="text" name="name" readonly value="<?php echo $name?>">
							<br>
							<br>

							<label>Contact No.</label>
							<br>
							<input type="number" name="phone" readonly value="<?php echo $phone?>">
							<br>
							<br>

							<label>Email</label>
							<br>
							<input type="email" name="email" readonly value="<?php echo $email?>">
							<br>
							<br>
						</div>
					</div>
					<br>
					<div>
						<input type="submit" value="Ok" style="float:right" id="em">
					</div>
				</form></div>
</body>
</html>