<?php
require 'db_conn.php';
session_start();
$id_user = $_SESSION['user']['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $semester = htmlspecialchars($_POST['semester']);
    $edu_year = htmlspecialchars($_POST['edu_year']);
    $cat_id = htmlspecialchars($_POST['cat_id']);
    $start = htmlspecialchars($_POST['start']);
    $end = htmlspecialchars($_POST['end']);
    $seats = htmlspecialchars($_POST['seats']);

    // สร้างคำสั่ง SQL เพื่ออัปเดตข้อมูลในฐานข้อมูล
    $sql = "UPDATE activities SET name = '$name',semester = '$semester', edu_year = '$edu_year', cat_id = '$cat_id', start = '$start', end = '$end', seats = '$seats' ,edited_by = '$id_user',edited_on = CURRENT_TIMESTAMP  WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Activity updated successfully";
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
