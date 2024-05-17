<?php
require 'db_conn.php';
session_start();
$id_user = $_SESSION['user']['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $activities = htmlspecialchars($_POST['activities']);
    $semester = htmlspecialchars($_POST['semester']);
    $edu_year = htmlspecialchars($_POST['edu_year']);
    $type_act = htmlspecialchars($_POST['type_act']);
    $start = htmlspecialchars($_POST['start']);
    $end = htmlspecialchars($_POST['end']);
    $amount = htmlspecialchars($_POST['amount']);

    // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูลเข้าไปในฐานข้อมูล
    $sql = "INSERT INTO activities (name, semester, edu_year, cat_id, start, end, seats,edited_by )
            VALUES ('$activities', '$semester', '$edu_year', '$type_act', '$start', '$end', '$amount', '$id_user')";

    if ($conn->query($sql) === TRUE) {
        echo "New activity created successfully";
        header('location: staff_main.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // ปิดการเชื่อมต่อ
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
