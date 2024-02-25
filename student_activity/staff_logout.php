<?php
    session_start();
    unset($_SESSION['user']);
    header('location: staff_login.php');
    exit();