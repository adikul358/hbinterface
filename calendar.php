<html>

<head>
	<link href="style.css" rel="stylesheet" type="text/css">
	<title>WCH Booking Interface - Shiv Nadar School, Noida</title>
</head>

<body>

	<div class="header">
		<div id="title">
			<h1>WCH Booking Interface</h1>
		</div>
		<img src="images\SNS_Logo.png" alt="Shiv Nadar School logo">

	</div>
	<script src="Java-Calendar/main.js"></script>
	<link rel="stylesheet" href="Java-Calendar/main.css">
	</head>

	<body>
		<div class="divcalendar">

			<div id="calendaroverallcontrols">
				<!-- <div id="year"></div> -->

				<div id="calendarmonthcontrols">
					<a id="btnPrevYr" href="#" title="Previous Year">
						<span>
							<img src="Java-Calendar/arrows/left_double.svg"></img>
						</span>
					</a>

					<a id="btnPrev" href="#" title="Previous Month">
						<span>
							<img src="Java-Calendar/arrows/left_single.svg"></img>
						</span>
					</a>

					<!-- <input type="button" src="images/btnprevmonth.png" alt="Submit" id="btnPrev"/>-->

					<!-- <div id="month"></div>-->

					<div id="monthandyear"></div>

					<!--<input type="button" src="images/btnnextmonth.png" alt="Submit" id="btnNext"/>-->

					<a id="btnNext" href="#" title="Next Month">
						<span>
							<img src="Java-Calendar/arrows/right_single.svg"></img>
						</span>
					</a>

					<a id="btnNextYr" href="#" title="Next Year">
						<span>
							<img src="Java-Calendar/arrows/right_double.svg"></img>
						</span>
					</a>
				</div>
			</div>
		</div>

		<div id="divcalendartable"></div>
	</body>

</html>
</BODY>

</HTML>


	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Calendar</title>


		<link href="http://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

		<script type="text/javascript">
			var check_array = [];

			$(document).ready(function () {

				$(".fields").click(function () {

					dataval = $(this).data('val');

					// Show the Selected Slots box if someone selects a slot
					if ($("#outer_basket").css("display") == 'none') {
						$("#outer_basket").css("display", "block");
					}

					if (jQuery.inArray(dataval, check_array) == -1) {
						check_array.push(dataval);
					} else {
						// Remove clicked value from the array
						check_array.splice($.inArray(dataval, check_array), 1);
					}

					slots = '';
					hidden = '';
					basket = 0;

					//cost_per_slot = parseFloat(cost_per_slot).toFixed(2)

					for (i = 0; i < check_array.length; i++) {
						slots += check_array[i] + '\r\n';
						hidden += check_array[i].substring(0, 8) + '|';
						//basket = (basket + parseFloat(cost_per_slot));
					}

					// Populate the Selected Slots section
					$("#selected_slots").html(slots);

					// Update hidden slots_booked form element with booked slots
					$("#slots_booked").val(hidden);

					// Update basket total box
					//basket = basket.toFixed(2);
					//$("#total").html(basket);	

					// Hide the basket section if a user un-checks all the slots
					if (check_array.length == 0)
						$("#outer_basket").css("display", "none");

				});


				$(".classname").click(function () {

					msg = '';

					if ($("#name").val() == '')
						msg += 'Please enter a Name\r\n';

					if ($("#email").val() == '')
						msg += 'Please enter an Email address\r\n';

					if ($("#phone").val() == '')
						msg += 'Please enter a Phone number\r\n';

					if (msg != '') {
						alert(msg);
						return false;
					}

				});

				// Firefox caches the checkbox state.  This resets all checkboxes on each page load 
				$('input:checkbox').removeAttr('checked');

			});
		</script>

	</head>

	<body>

		

	</body>

	</html>