<?php
require 'db_conn.php';
session_start();
$id_user = $_SESSION['user']['id'];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // รับ ID ที่ถูกส่งมาจากฟอร์ม
    $id = intval($_GET['id']);

    // สร้างคำสั่ง SQL เพื่อลบข้อมูล
    $sql = "DELETE FROM activities WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header('location: staff_main.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // ปิดการเชื่อมต่อ
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
