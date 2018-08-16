<html>

<head>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="Java-Calendar/main.css">
	<script src="Java-Calendar/main.js"></script>
	<?php require "connect.php"?>
	<title>WCH Booking Interface - Shiv Nadar School, Noida</title>

	<?php

		session_start();

		$m = $_GET['m'];
		$m++; 
		$currdate = date("Y\-m\-d", mktime(0,0,0,$m, $_GET['d'], $_GET['y']));
		$_SESSION['date'] = $currdate;

		$booking_query = "SELECT * FROM bookings WHERE date='$currdate'  ORDER BY start";
		$result = mysqli_query($link, $booking_query);

		if (!$result) {
			exit("Failed to fetch:<br>" . mysqli_error($link));
		}
		
		$bookings = array();
		while($row = mysqli_fetch_assoc($result)) {
			$bookings[] = $row;
		}
		$timing_query = "SELECT DISTINCT start FROM bookings WHERE date='$currdate'  ORDER BY start";
		$tresult = mysqli_query($link, $timing_query);

		if (!$tresult) {
			exit("Failed to fetch:<br>" . mysqli_error($link));
		}
		$tn = mysqli_num_rows($tresult);
		
		$timings = array();
		while($row = mysqli_fetch_assoc($tresult)) {
			$timings[] = $row;
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
	<div class="divcalendar">

<div id="calendaroverallcontrols">
	<!-- <div id="year"></div> -->

	<div id="calendarmonthcontrols">
		<a class="calcon left" id="btnPrevDay" href="#" onclick="<?php echo "prevDay(" . $_GET['d'] . "," . $_GET['m'] . "," . $_GET['y'] . ")"?>">
				<img src="Java-Calendar/arrows/left_single.svg">
		</a>

		<div id="bookedday"><div id=monthandyearspan><?php echo date('j', mktime(0, 0, 0, 1, $_GET['d'])) . " " . date('F', mktime(0, 0, 0, $m, 10)) . " - " . $_GET['y'];?></div></div>


		<a class="calcon right" id="btnNextDay" href="#"  onclick="<?php echo "nextDay(" . $_GET['d'] . "," . $_GET['m'] . "," . $_GET['y'] . ")"?>">
				<img src="Java-Calendar/arrows/right_single.svg">
		</a>
	</div>
</div>
</div>
		
		<div id="bofoma">
			<div id="content">
				<div id="titlespan" style="display: block; border-bottom: 2px solid black; width: 80%;">Booked Slots</div>
				<div id="bkdslts">
					<?php 
						$counter = 1;
						$js1 = "<script>
									var rows = ";
						$js2 = ";
						if (rows == 12) {
									document.getElementById('adda').removeAttribute('href');
									document.getElementById('adda').removeAttribute('onclick');
									document.getElementById('adda').innerHTML = '';
									document.getElementById('adda').innerHTML = '<img src=images/block.svg id=blockico>';
								} else {
									document.getElementById('adda').setAttribute('href') = '#';
									document.getElementById('adda').setAttribute('onclick') = 'launchForm()';
									document.getElementById('adda').innerHTML = '';
									document.getElementById('adda').innerHTML = '<img src=images/add.svg id=addico>;'
								}
								</script>";

						switch ($r) {
							case 0:
								echo '<h3 id="noro">No bookings yet</h3>';
								break;
							
							default:
							# code...
							echo '<table> 
							<tr>
								<th class="daysheaderl">S No.</th>
								<th class="daysheaderl">Event</th>
								<th class="daysheaderl">Start time</th>
								<th class="daysheaderl">End time</th>
								<th class="daysheaderl">Person Booking</th>
							</tr>';
	
							foreach ($bookings as $row) {
								$html = '<tr>';
								$html .= '<td class="bkdslts" style="width:80px">' . $counter . '</td>';
								$html .= '<td class="bkdslts" style="text-align:left; width:350px">' . $row['event'] . '</td>';
								$html .= '<td class="bkdslts" style="width:100px">' . date('h:i A', strtotime($row['start'])) . '</td>';
								$html .= '<td class="bkdslts" style="width:100px">' . date('h:i A', strtotime($row['end'])) . '</td>';
								$html .= '<td class="bkdslts" style="width:200px">' . $row['name'] . '<h5><a id="contact" onclick="conpop(' . "'" . $row['name'] . "'" . ",'" . $row['email'] . "','" . $row['phone'] . "'" . ')" href="#">Contact Info</a></h5></td>';
								$html .= '</tr>';
								$counter++;
								echo $html;
							}
							$cjs = $counter;
							break;
						}
						?>
					</table>
				</div>
			</div>
			<div id="add">
				<div id=k style="margin:15px">
						<span id="titlespan" style="margin-right: 15px">Book a Slot</span>
						<a href="#" id="adda" onclick="launchForm()">
								<img src="images/add.svg" id="addico">
							</a>
							
						</div>
					</div>
				</div>
				<?php echo $js1 . $counter . $js2;?>
		<div id="booking-form">
			<div id=mbf>
				<form method="POST" action="<?php echo 'confirm.php?date=' . $currdate?>">
					<div id="form">

						<label>Event Name</label>
						<br>
						<input type=text name="event" required>
						<br>
						<br>

						<div id="times">
							
							<div style="width: 50%; float: left">
								<label>Start Time</label>
								<br>
								<select name="start" id=s onchange="cp()">
									<?php

										$slots = array();
										for($i = strtotime("09:00"); $i<= strtotime("14:50"); $i= $i+35*60) {
											$slots[] = date("h:i A", $i); 
											$server_slots[] = date("H:i:s", $i); 
										}
										$c = 0;

										// $c = 0;
										// foreach ($slots as $s) {
										// 	echo '<option value="' . $server_slots[$c] . '" name="' .$s .'">' . $s . '</option>';
										// 	$c++;
										// }
										foreach ($server_slots as $s) {
											$present = false;
											if ($tn == 0) {
												echo '<option value="' . $s . '" name="' .$slots[$c] .'">' . $slots[$c] . '</option>';
											} else {
											foreach ($timings as $t) {
												if ($t['start'] == $s) {
													echo '';
													$present = false;
												} else {
													$present = true;
												}
											}
												if ($present) {
													echo '<option value="' . $s . '" name="' .$slots[$c] .'">' . $slots[$c] . '</option>';
													$present = false;
												}
											}
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
								</select>
								<br>
							</div>
							<script>cp()</script>

							<br>
							<br>
							<label>Name of Person Booking</label>
							<br>
							<input type="text" name="name" required>
							<br>
							<br>

							<label>Contact No.</label>
							<br>
							<input type="text" name="phone" minlength=10 required>
							<br>
							<br>

							<label>Email</label>
							<br>
							<input type="email" name="email" required>
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
								<label class=info id="conemail"></label>
								<label class=info id="conphone"></label>
							</div>
						</div>
					</div>
					<br>
						<div>
							<input type="button" value="Ok" onclick="condown()" style="float:right" id="conm">
						</div>
				</div>
			</div>
			<script>
				prevavail(<?php echo $_GET['d'] . "," . $_GET['m'] . "," . $_GET['y']?>);
		</script>
	</body>

</html>