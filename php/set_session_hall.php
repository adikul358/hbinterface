<?php
    session_start();
    $_SESSION['hall'] = $_POST['hall'];
    if ($_POST['redirect'] == true) {
        echo 'redirect';
    }
?>