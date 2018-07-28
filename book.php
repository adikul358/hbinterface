<html>

<head>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="Java-Calendar/main.css">
	<script src="Java-Calendar/main.js"></script>
	<?php require "php/connect.php"?>
	<title>WCH Booking Interface - Shiv Nadar School, Noida</title>

	<?php

		$m = $_GET['m'];
		$m++; 
		$currdate = $_GET['y'] . '-' . $m . '-' . $_GET['d'];

		$booking_query = "SELECT start, name FROM bookings WHERE date='2017-02-17'";
		$result = mysqli_query($link, $booking_query);

		if (!$result) {
			exit("Failed to fetch:<br>" . mysqli_error($link));
		}

		$bookings = array();
		while($row = mysqli_fetch_assoc($result)) {
			$bookings[] = $row;
		}

	?>
</head>

<body>

	<div class="header">
		<div id="title">
			<a href="index.php" style="text-decoration: none"><h1>WCH Booking Interface</h1></a>
		</div>
		<img src="images\SNS_Logo.png" alt="Shiv Nadar School logo" id="schlo">

	</div>

	<body>
		<div id="content">
			<div id="titlespan" style="display: block; border-bottom: 2px solid black; width: 80%;">Booked Slots</div>
			<div id="bkdslts">
				<table>
					<tr>
						<th class="daysheader">S No.</th>
						<th class="daysheader">Event</th>
						<th class="daysheader">Start time</th>
						<th class="daysheader">End time</th>
						<th class="daysheader" colspan="2">Booker</th>
					</tr>
					<?php 
						$counter = 1;
						foreach ($bookings as $row) {
							$html = '<tr>';
							$html .= '<td class="bkdslts">' . $counter . '</td>';
							$html .= '<td class="bkdslts">' . 'Event' . '</td>';
							$html .= '<td class="bkdslts">' . $row['start'] . '</td>';
							$html .= '<td class="bkdslts">' . 'End Time' . '</td>';
							$html .= '<td class="bkdslts">' . $row['name'] . '</td>';
							$html .= '<td class="bkdslts">' . 'Contact Info' . '</td>';
							$html .= '</tr>';
							$counter++;
							echo $html;
						}
					?>
				</table>
			</div>
			<div>
				<span id="titlespan" style="margin-right: 15px">Book a Slot</span>
				<a href="#" id="add" onclick="launchForm()"><img src="images/add.svg" id="addico"></a>
			</div>
		</div>
		<div id="booking-form">
			<div id="text">
				<form action="" method="POST">
					<
				</form>
			</div>
		</div>
	</body>

</html>