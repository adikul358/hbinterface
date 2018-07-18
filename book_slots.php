<?php

include('php/connect.php'); 

if(isset($_POST['slots_booked'])) $slots_booked = mysqli_real_escape_string($link, $_POST['slots_booked']);
if(isset($_POST['name'])) $name = mysqli_real_escape_string($link, $_POST['name']);
if(isset($_POST['email'])) $email = mysqli_real_escape_string($link, $_POST['email']);
if(isset($_POST['phone'])) $phone = mysqli_real_escape_string($link, $_POST['phone']);
if(isset($_POST['booking_date'])) $booking_date = mysqli_real_escape_string($link, $_POST['booking_date']);


$booking_array = array(
	"slots_booked" => $slots_booked,	
	"booking_date" => $booking_date,
	"name" => $name,
	"email" => $email,
	"phone" => $phone
);

$explode = explode('|', $slots_booked);

foreach($explode as $slot) {

	if(strlen($slot) > 0) {

		$stmt = $link->prepare("INSERT INTO bookings (date, start, name, email, phone) VALUES (?, ?, ?, ?, ?)"); 
		$stmt->bind_param('sssss', $booking_date, $slot, $name, $email, $phone);
		$stmt->execute();
		
	} // Close if
	
} // Close foreach

//print_r('<pre>');
//print_r($booking_array);
//print_r('</pre>');

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Booking Confirmed</title>
</head>

<body>

<div class='success'>The booking has been made into the database.</div>


<?php
 // the following is the code for sending the booking details to outlook.

if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "root@localhost.com";
 
    $email_subject = "WCH Booking Requirement";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
        echo "These errors appear below.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['slots_booked']) ||
 
        !isset($_POST['booking_date']) ||
 
            !isset($_POST['name']) ||
 
        !isset($_POST['email'])||
 
        !isset($_POST['phone'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }
 
     
 
    $slots_booked= $_POST['slots_booked']; // required
 
    $booking_date = $_POST['booking_date']; // required
 
    $name = $_POST['name']; // not required
	 
	 $email = $_POST['email']; // not required
 
    $phone = $_POST['phone']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email)) {
 
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
 
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
 
  }
 
 
 
    $email_message = "Form details below.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "Name: ".clean_string($name)."\n";
 
    $email_message .= "Email: ".clean_string($email)."\n";
 
    $email_message .= "Telephone: ".clean_string($phone)."\n";
 
     $email_message .= "Slot Time: ".clean_string($slots_booked)."\n";
	 
	 $email_message .= "Booking Time: ".clean_string($booking_date)."\n";
	 
 	 
    
     
 
     
 
// create email headers
 
$headers = 'From: '.$email."\r\n".
 
'Reply-To: '.$email."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  
 
?>
 
 
 
<!-- include your own success html here -->
 
 
 
Thank you for contacting us. We will be in touch with you very soon.
 
 
 
<?php
 
}
 
?>

</body>

</html>
