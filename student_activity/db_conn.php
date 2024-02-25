<?php
    $servername = "db403-mysql";
    $database = "student_activity";
    $username = "root";
    $password = "P@ssw0rd";

    try {
        $conn = new mysqli($servername, $username, $password, $database);
    }
    catch (Exception) {
        die('Connection error');
    }
