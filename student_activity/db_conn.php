<?php
    $servername = "localhost";
    $database = "student_activity";
    $username = "root";
    $password = "";

    try {
        $conn = new mysqli($servername, $username, $password, $database);
    }
    catch (Exception) {
        die('Connection error');
    }
?>