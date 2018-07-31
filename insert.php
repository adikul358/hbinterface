<html>

<head>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="Java-Calendar/main.css">
	<link rel="stylesheet" href="pop.css">
	<script src="Java-Calendar/main.js"></script>
	<?php require "php/connect.php"?>
	<title>WCH Booking Interface - Shiv Nadar School, Noida</title>

	<?php

		$hide = "";

		$m = $_GET['m'];
		$m++; 
		$currdate = date("Y\-m\-d", mktime(0,0,0,$m, $_GET['d'], $_GET['y']));

		$booking_query = "SELECT * FROM bookings WHERE date='$currdate'  ORDER BY start";
		$result = mysqli_query($link, $booking_query);

		if (!$result) {
			exit("Failed to fetch:<br>" . mysqli_error($link));
		}
		
		$bookings = array();
		while($row = mysqli_fetch_assoc($result)) {
			$bookings[] = $row;
		}
		$r = mysqli_num_rows($result);
		
		if (isset($_POST['submit'])) {
			$name = mysqli_real_escape_string($link, $_POST['name']);
			$email = mysqli_real_escape_string($link, $_POST['email']);
			$phone = mysqli_real_escape_string($link, $_POST['phone']);
			$event = mysqli_real_escape_string($link, $_POST['event']);
			$start = mysqli_real_escape_string($link, $_POST['start']);
			$end = mysqli_real_escape_string($link, $_POST['end']);
			
			$event_query = "INSERT INTO bookings (event, date, start, end, name, phone, email)
			VALUES ('$event', '$currdate', '$start', '$end', '$name', '$phone', '$email')";
			$eresult = mysqli_query($link, $event_query);

			if(!$eresult) {
				echo "Failed to fetch:<br>" . mysqli_error($link);
			} else {
				echo 'successfull';
			}


		}		
	?>
</head>

<body style="background-color: white">
			<div id=mbf style="animation: none">
				<form method="POST" action="">
					<div id="form">

						<label>Event Name</label>
						<br>
						<input type=text name="event" >
						<br>
						<br>

						<div id="times">
							
							<div style="width: 50%; float: left">
								<label>Start Time</label>
								<br>
								<select name="start" id=s onchange="cp()" >
									<?php

										$slots = array();
										for($i = strtotime("09:00"); $i<= strtotime("14:50"); $i= $i+35*60) {
											$slots[] = date("h:i", $i); 
											$server_slots[] = date("H:i:s", $i); 
										}
										$c = 0;
										foreach ($slots as $s) {
											echo '<option value="' . $server_slots[$c] . '" name="' .$s .'">' . $s . '</option>';
											$c++;
										}

								?>
								</select>
								<br>
							</div>
							
							<div>
								<label>End Time</label>
								<br>
								<select name="end" id=e >
									<?php

										$slots = array();
										for($i = strtotime("09:35"); $i<= strtotime("15:25"); $i= $i+35*60) {
											$slots[] = date("h:i", $i); 
											$server_slots[] = date("H:i:s", $i); 
										}
										$c = 0;
										foreach ($slots as $s) {
											echo '<option value="' . $server_slots[$c] . '" name="' .$s .'">' . $s . '</option>';
											$c++;
										}

									?>
								</select>
								<br>
							</div>
							
							<br>
							<br>
							<label>Name of Person Booking</label>
							<br>
							<input type="text" name="name" >
							<br>
							<br>

							<label>Contact No.</label>
							<br>
							<input type="number" name="phone" >
							<br>
							<br>

							<label>Email</label>
							<br>
							<input type="email" name="email" >
							<br>
							<br>
						</div>
					</div>
					<br>
					<div>
						<input type="submit" value="Book Hall" style="float:right" id="em">
					</div>
				</form>
		</div>	
</body>
</html>