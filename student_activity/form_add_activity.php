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
                    <li><a href="#" class="nav-link px-2 link-secondary">Activities</a></li>
                    <li><a href="#" class="nav-link px-2 link-body-emphasis">Report</a></li>
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
                <h1 class="display-6">Activities</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="add_activity.php" method="post">
                    <div class="mb-3">
                        <label for="Activities" class="form-label">ชื่อกิจกรรม</label>
                        <input type="text" class="form-control" id="Activities" name="activities" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ภาคการศึกษา</label>
                        <div class="row">
                            <div class="col-lg-2">
                                <input type="text" class="form-control" id="semester" name="semester"
                                    style="text-align: right;" required>
                            </div>
                            <div class="col-lg-1" style="text-align: center;">
                                /
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" id="edu_year" name="edu_year" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ประเภท</label>
                        <select class="form-select" aria-label="Default select example" id="type_act" name="type_act"
                            required>
                            <option selected disabled>กรุณาเลือก</option>
                            <?php
                             $sql = "SELECT * FROM `categories`"; 
                             $result = $conn->query($sql);
                                 while($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?=$row['id']?>"><?=$row['name']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">เริ่ม</label>
                        <input type="date" class="form-control" id="start" name="start" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">สิ้นสุด</label>
                        <input type="date" class="form-control" id="end" name="end" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">จำนวน</label>
                        <div class="row">
                            <div class="col-lg-3">
                                <input type="number" class="form-control" id="amount" name="amount" required>
                            </div>
                            <div class="col-lg-1" style="text-align: center;">
                                คน
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="text-align: center;">
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                    </div>
                </form>


            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>