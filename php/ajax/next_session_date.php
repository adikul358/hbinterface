<?php
    session_start();
    $NewDate = new DateTime($_POST['date']);
    $NewDate->add(new DateInterval('P1D'));
    $_SESSION['date'] = $NewDate->format('Y-m-d');
?>