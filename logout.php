<?php
    session_start();
    //session_destroy();
    //session_unset();
    unset($_SESSION['user_role']);
    unset($_SESSION['firstname']);
    unset($_SESSION['username']);
    header('location: login.php');
?>