<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location: index.php');
        exit();
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
</head>
<body>
    ยินดีต้อนรับ คุณ<?php echo $_SESSION['user']['fullname'];?>
    <h3><a href="Signout.php">Signout</a></h3>
</body>
</html>