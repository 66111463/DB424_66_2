<?php
require 'db_conn.php';
session_start();
$id_user = $_SESSION['user']['id'];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id_students = intval($_GET['id_students']);
    $act_id = intval($_GET['act_id']);

    // สร้างคำสั่ง SQL เพื่ออัปเดตข้อมูลในฐานข้อมูล
    $sql = "UPDATE enrollments SET status = '1',approved_on = CURRENT_TIMESTAMP WHERE stu_id = '$id_students' and act_id = '$act_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Activity updated successfully";
        header('location: student_approve.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // ปิดการเชื่อมต่อ
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
