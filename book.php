<html>

<head>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="Java-Calendar/main.css">
	<link rel="stylesheet" href="pop.css">
	<script src="Java-Calendar/main.js"></script>
	<?php require "connect.php"?>
	<title>WCH Booking Interface - Shiv Nadar School, Noida</title>

	<?php

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

		function coninfo($name) {
			$con_query = "SELECT DISTINCT name, phone, email FROM bookings WHERE name='$name'";
			$conresult = mysqli_query($link, $con_query);
			$con = array();
			while($row = mysqli_fetch_assoc($conresult)) {
				$con[] = $row;
			}
		}
		
	?>
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

	<body>
		<div id="bofoma">
			<div id="content">
				<div id="titlespan" style="display: block; border-bottom: 2px solid black; width: 80%;">Booked Slots</div>
				<div id="bkdslts">
					<?php 
						$counter = 1;

						switch ($r) {
							case 0:
								echo '<h3 id="noro">No bookings yet</h3>';
								break;
							
							default:
							# code...
							echo '<table> 
							<tr>
								<th class="daysheader">S No.</th>
								<th class="daysheader">Event</th>
								<th class="daysheader">Start time</th>
								<th class="daysheader">End time</th>
								<th class="daysheader">Person Booking</th>
							</tr>';
	
							foreach ($bookings as $row) {
								$html = '<tr>';
								$html .= '<td class="bkdslts" style="width:80px">' . $counter . '</td>';
								$html .= '<td class="bkdslts" style="text-align:left; width:350px">' . $row['event'] . '</td>';
								$html .= '<td class="bkdslts" style="width:100px">' . $row['start'] . '</td>';
								$html .= '<td class="bkdslts" style="width:100px">' . $row['end'] . '</td>';
								$html .= '<td class="bkdslts" style="width:200px">' . $row['name'] . '<h5><a id="contact" onclick="conpop(' . "'" . $row['name'] . "'" . ",'" . $row['email'] . "','" . $row['phone'] . "'" . ')" href="#">Contact Info</a></h5></td>';
								$html .= '</tr>';
								$counter++;
								echo $html;
							}
								break;
						}
					?>
					</table>
				</div>
			</div>
			<div id="add">
				<div id=k style="margin:15px">
					<span id="titlespan" style="margin-right: 15px">Book a Slot</span>
					<a href="#" id="add" onclick="launchForm()">
						<img src="images/add.svg" id="addico">
					</a>
				</div>
			</div>
		</div>
		<div id="booking-form">
			<div id=mbf>
				<form method="POST" action=>
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
		</div>
				<div id="mainconinfo">
				<div id="ne">
					<div id="coninfo">
						<h1 id="contitle"></h1>

						<div class="first">

							<div id="firstt">
								<label class=tag>Email:</label>
								<label class=tag>Phone:</label>
							</div>

							<div id="firsti">
								<label class=info id="conemail">adi.kul358@gmail.com</label>
								<label class=info id="conphone">7840869129</label>
							</div>
						</div>
					</div>
					<br>
						<div>
							<input type="button" value="Ok" onclick="condown()" style="float:right" id="conm">
						</div>
				</div>
			</div>
	</body>

</html>