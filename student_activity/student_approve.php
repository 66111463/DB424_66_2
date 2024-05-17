<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location: staff_login.php');
        exit();
        }
        require 'db_conn.php';
?>
<!-- <!DOCTYPE html>
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
</html> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Statff Activity</title>

</head>

<body>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="main.php"
                    class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <img src="images/logo.png" svg class="bi me-2" width="40" height="32" role="img"
                        aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"></use></svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <?php
                    require 'staff_menu.php';
                    ?>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
            //   if($_SESSION['user']['pic'] == null) {
            ?>
                        <span class="material-symbols-outlined" style="color:gray;frontsize:24pt;">account_circle</span>
                        <?php
            //   }
            //   else {
                // echo"<img src='images/student/{$_SESSION['user']['pic']}'
                // width='32' height='32' class'rounded-circle'>";
            //   }
            ?>
                        <!-- <img src="images/profile.jpg" alt="mdo" width="32" height="32" class="rounded-circle"> -->
                    </a>
                    <ul class="dropdown-menu text-small" style="">
                        <li><b class="dropdown-item"><?php echo $_SESSION['user']['fullname'];?></b></li>
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="signout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-lg-11">
                <h3>Student Register</h3>
            </div>
        </div>

        <table class="table table-striped">
            <tr>
                <th class="text-center">ผู้สมัคร</th>
                <th class="text-center">กิจกรรม</th>
                <th class="text-center">ประเภท</th>
                <th class="text-center">สถานะ</th>
                <th class="text-center"></th>
                <!-- <th class="text-center"></th> -->
            </tr>
            <?php 
            
             $sql = "SELECT students.fullname as name_students,students.id as id_students,enrollments.act_id,enrollments.status,activities.name as name_act,categories.name as name_cat FROM students,enrollments ,activities,categories WHERE enrollments.act_id = activities.id and activities.cat_id = categories.id and students.id = enrollments.stu_id;"; //ตัวเลือกโดยใช้ subquery ใน where เป็น not in
            $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    ?>
            <tr class="text-center">
                <td><?=$row['name_students']?></td>
                <td><?=$row['name_act']?></td>
                <td><?=$row['name_cat']?></td>
                <td>
                    <?php
                    if ($row['status'] == 0) {
                        echo "รออนุมัติ";
                    } elseif ($row['status'] == 1) {
                        echo "อนุมัติ";
                    }
                    ?>
                </td>
                <td><a class='btn btn-primary btn-sm' href="approve.php?id_students=<?=$row["id_students"]?>&act_id=<?=$row["act_id"]?>">อนุมัติ</a></td>
                <!-- <td><a class='btn btn-danger btn-sm' href="delete_activity.php?id=<?=$row["id"]?>">ลบ</a></td> -->
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>