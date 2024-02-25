<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location: staff_login.php');
        exit();
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Main</title>
</head>
<body>
    สวัสดีแอดมิน <?php echo $_SESSION['user']['fullname'];?>
    <h3><a href="staff_logout.php">Logout</a></h3>
</body>
</html>