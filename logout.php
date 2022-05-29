<?php
    include 'check.php';

    if (!checked()){
        header("Location: login.php");
        exit;
    }

    session_start();
    session_destroy();

    header('Location: login.php');
?>