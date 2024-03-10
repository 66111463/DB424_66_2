<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location: index.php');
        exit();
        }
    require 'db_conn.php';

    if (isset($_POST['submit'])) {
        //var_dump($_FILES['pic']); //ตรวจสอบการทำงานของการ upload image file ด้วย var_dump
        

        $image = $_SESSION['user']['pic'];
        if ($_FILES['pic']['name'] != '') {
            $target_file = "{$_SESSION['user']['id']}.".pathinfo($_FILES["pic"]["name"], PATHINFO_EXTENSION);
            if (move_uploaded_file($_FILES["pic"]["tmp_name"], "images/student/$target_file")) {
                $image = $target_file;
                }
            }
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        $dep_id = $_POST['dep_id'];

        $sql = "update students set fullname=?, email=?, dep_id=?, pic='$image'
                where id='{$_SESSION['user']['id']}'";

        $stm = $conn->prepare($sql);
        $stm->bind_param('sss', $fullname, $email, $dep_id);
        $stm->execute();
        $_SESSION['user']['fullname'] = $fullname;
        $_SESSION['user']['pic'] = $image;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>Student Profile</title>
        <style>
            html,
            body {
                height: 100%;
            }

            .form-signin {
                max-width: 330px;
                padding: 1rem;
            }

            .form-signin .form-floating:focus-within {
                z-index: 2;
            }

            .form-signin input[name="id"] {
                margin-bottom: -1px;
                border-top-right-radius: 6px;
                border-top-left-radius: 6px;
            }

            #floatingDepartment {
                margin-bottom: 10px;
                border-bottom-left-radius: 6px;
                border-bottom-right-radius: 6px;
            }
        </style>
        <script>
            function changeFaculty() {
                let id = document.getElementById('floatingFaculty').value; //สร้างตัวแปรใน java script ใช้ let จากนั้นส่งค่าให้เก็บเป็น .value
                fetch('departments.php?id='+id)
                .then(resp=>resp.json())
                .then(data=>{
                    let departments = document.getElementById('floatingDepartment');
                    let options = '';
                    for (let dep of data) {
                        options += `<option value="${dep.id}">${dep.name}</option>`; //+= คือเอาของเดิมมารวมกับของใหม่ //หากต้องการแทรกตัวแปรใน string บน java script ให้ใช้ backtick
                    }
                    departments.innerHTML = options; // .innerHTML คือที่อยู่ระหว่าง Tag เปิด กับ Tag ปิด
                });
            }
            
            function preview() {
                const pic_label = document.getElementById('pic-label');
                pic_label.innerHTML = '<img class="rounded-circle" style="height:150px;">';
                const img = pic_label.querySelector('img');
                const profileImage = document.getElementById('pic');
                img.src = URL.createObjectURL(profileImage.files[0]);
                img.onload = () => {
                    URL.revokeObjectURL(img.src);
                }; // function ที่ใช้เพื่ออ้างถึง image ที่จะ preview
            }
        </script>
    </head>
    <body>
        <header class="p-3 mb-3 border-bottom">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="main.php" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                        <img src="images/logo.png" svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
                    </a>
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="main.php" class="nav-link px-2 link-secondary">Activities</a></li>
                        <li><a href="#" class="nav-link px-2 link-body-emphasis">Report</a></li>
                    </ul>
                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                        <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                    </form>
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            if($_SESSION['user']['pic'] == null) {
                            ?>
                                <span class="material-symbols-outlined" style="color:gray;frontsize:24pt;">account_circle</span>
                            <?php
                                }
                                else {
                                echo"<img src='images/student/{$_SESSION['user']['pic']}'
                                width='32' height='32' class'rounded-circle'>";
                                }
                            ?>
                            <!-- <img src="images/profile.jpg" alt="mdo" width="32" height="32" class="rounded-circle"> -->
                        </a>
                        <ul class="dropdown-menu text-small" style="">
                            <li><b class="dropdown-item"><?php echo $_SESSION['user']['fullname'];?></b></li>
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="signout.php">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="container">
            <?php
                require 'db_conn.php';
                $sql = "select S.id, fullname, email, pic, dep_id, fac_id
                        from students S
                        join departments D on S.dep_id=D.id
                        join faculties F on D.fac_id=F.id
                        where S.id='{$_SESSION['user']['id']}'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

            ?>
            <div class="d-flex align-items-center py-4 bg-body-tertiary">
                <main class="form-signin w-100 m-auto">
                    <form method="post" enctype="multipart/form-data"> <!--กรณีที่ input ชนิด file เข้ามาต้องมีการ encode type เป็น multipart ด้วยเสมอ -->
                        <img class="mb-4" src="images/logo.png" alt="" width="72" height="57">
                        <span class="h3 text-success">Student Activity</span>
                        <h1 class="h3 mb-3 fw-normal">Profile</h1>
                        <?php
                            if (isset($error)) {
                                echo "<div class='alert alert-danger'>$error</div>"; // Ref: https://getbootstrap.com/docs/5.3/components/alerts/
                            }
                        ?>
                        <div class="mb-3">
                            <label for="pic" id="pic-label">
                                <?php
                                    if ($row['pic'] == null) {
                                ?>
                                        <span class="material-symbols-outlined" style="color:gray;font-size:75pt;">account_circle</span>
                                <?php
                                    }
                                    else {
                                        echo "<img class='rounded-circle' style='height:150px;' src='images/student/{$row['pic']}'>";
                                    }
                                ?>
                            </label>
                            <input name="pic" type="file" accept="image/*" class="d-none" id="pic" onchange="preview()"> <!-- อาจใส่ค่า class เป็น display none เพื่อไม่ให้แสดงเมนู browse ออกมา display ก็ได้ -->
                            <!-- accept="image/*" เลือกได้เฉพาะไฟล์ที่เป็น images เท่านั้น -->
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingStudentID" placeholder="Student ID" readonly 
                                value="<?php echo $row['id'];?>" 
                            > <!-- ใช้ value ที่ได้จากตัวแปร $row[] -->
                            <label for="floatingStudentID">Student ID</label>
                        </div>
                        <div class="form-floating">
                            <input name="fullname" type="text" class="form-control" id="floatingFullname" placeholder="Fullname" requried
                                value="<?php echo $row['fullname'];?>"
                            >
                            <label for="floatingFullname">Fullname</label>
                        </div>
                        <div class="form-floating">
                            <input name="email" type="email" class="form-control" id="floatingEmail" placeholder="Email address" requried
                                value="<?php echo $row['email'];?>"
                            >
                            <label for="floatingEmail">Email address</label>
                        </div>
                        <div class="form-floating">
                            <select class="form-select" id="floatingFaculty" placeholder="Faculty" onchange="changeFaculty()">
                                <?php
                                    $sql = 'select * from faculties order by id';
                                    $result = $conn->query($sql);
                                    while ($fac = $result->fetch_assoc()) {
                                        echo "<option value='{$fac['id']}'"
                                        .($fac['id']==$row['fac_id']? ' selected':'')
                                        .">{$fac['name']}</option>";
                                    }
                                ?>
                            </select>
                            <label for="floatingFaculty">Faculty</label>
                        </div>
                        <div class="form-floating">
                            <select name="dep_id" class="form-select" id="floatingDepartment" placeholder="Department">
                                <?php
                                    $sql = "select id, name from departments where fac_id={$row['fac_id']}";
                                    $result = $conn->query($sql);
                                    while ($dep = $result->fetch_assoc()) {
                                        echo "<option value='{$dep['id']}'"
                                        .($dep['id']==$row['dep_id']? ' selected':'')
                                        .">{$dep['name']}</option>";
                                    }
                                    $conn->close();
                                ?>
                                <!-- <option selected>IS</option>
                                <option>BI</option>
                                <option>AC</option> -->
                            </select>
                            <label for="floatingFaculty">Department</label>
                        </div>                        
                        <button name="submit" class="btn btn-primary w-100 py-2" type="submit">Save</button>
                    </form>
                </main>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            </div>
        </div>
    </body>
</html>