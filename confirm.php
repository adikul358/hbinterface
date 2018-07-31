<?php 
    
    require "connect.php";

    $name = mysqli_real_escape_string($link, $_POST['name']);
    $event = mysqli_real_escape_string($link, $_POST['event']);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $date = strtotime($_GET['date']);

    $event_query = "INSERT INTO bookings (event, date, start, end, name, phone, email)
    VALUES ('$event', '$currdate', '$start', '$end', '$name', '$phone', '$email')";
    $eresult = mysqli_query($link, $event_query);
    if(!$eresult) {
        die("Failed to fetch:<br>" . mysqli_error($link));
    }
    echo 'fuck';
        
?>