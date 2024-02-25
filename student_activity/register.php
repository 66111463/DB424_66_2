<?php
    session_start();  
    require 'db_conn.php';

    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        $dep_id = $_POST['dep_id'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //echo password_hash($password, PASSWORD_DEFAULT)
        //$sql = "insert into
        //        students (id, fullname, email, dep_id, password)
        //        values ('$id', '$fullname', '$email', '$dep_id', '$password')";

        $sql = "insert into
        students (id, fullname, email, dep_id, password)
        values (?, ?, ?, ?, ?)"; // ใส่ ? เพื่อใช้รับข้อมูลจากข้างนอกโดยเฉพาะ

        try {
            $stm = $conn->prepare($sql);
            $stm->bind_param('sssss', $id, $fullname, $email, $dep_id, $password); //'sssss' คือตัวย่อว่าจาก datatype ของ SQL prepare statements ตามจำนวนของข้อมูล
            $stm->execute();
            $_SESSION['user'] = ['id'=>$id, 'fullname'=>$fullname];
            header('location: main.php');
            exit();
        }
        catch (Exception $e) {
            //$error = $e->getMessage(); //เก็บ error เป็น Massage เข้าตัวแปร
            $error ='Somthing wrong in registration';
        }
    }
    $conn->close();
?>

<!doctype html>
<html lang="en">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student Activity: Sign Up</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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

            .form-signin input, .form-signin select {
                margin-bottom: -1px;
                border-radius: 0;
            }

            .form-signin input[name="password"] {
                margin-bottom: 10px;
                border-bottom-left-radius: 6px;
                border-bottom-right-radius: 6px;
            }
        </style>
    </head>
    <body class="d-flex align-items-center py-4 bg-body-tertiary">
        <main class="form-signin w-100 m-auto">
            <form method="post">
                <!-- <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
                <h1 class="h3 mb-3 fw-normal">Fill in your information</h1>
                <?php
                    if (isset($error)) {
                        echo "<div class='alert alert-danger'>$error</div>"; // Ref: https://getbootstrap.com/docs/5.3/components/alerts/
                    }
                ?>
                <div class="form-floating">
                    <input name="id" type="text" class="form-control" id="floatingEmail" placeholder="Student ID" requried>
                    <label for="floatingEmail">Student ID</label>
                </div>
                <div class="form-floating">
                    <input name="fullname" type="text" class="form-control" id="floatingEmail" placeholder="Fullname" requried>
                    <label for="floatingEmail">Fullname</label>
                </div>
                <div class="form-floating">
                    <input name="email" type="email" class="form-control" id="floatingEmail" placeholder="Email address" requried>
                    <label for="floatingEmail">Email address</label>
                </div>
                <div class="form-floating">
                    <select class="form-select" id="floatingFaculty" placeholder="Faculty">
                        <option value="1">CIBA</option>
                        <option value="2">CITE</option>
                        <option value="3">ANT</option>
                        <option value="4" selected>IC</option>
                    </select>
                    <label for="floatingFaculty">Faculty</label>
                </div>
                <div class="form-floating">
                    <select name="dep_id" class="form-select" id="floatingDepartment" placeholder="Department">
                        <option selected>IS</option>
                        <option>BI</option>
                        <option>AC</option>
                    </select>
                    <label for="floatingFaculty">Department</label>
                </div>
                <div class="form-floating">
                    <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" requried>
                    <label for="floatingPassword">Password</label>
                </div>
                
                <button name="submit" class="btn btn-primary w-100 py-2" type="submit">Sign Up</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Aleady have an account? <a href="index.php" class="link-danger">Sign In</a></p>
                <!-- <p class="mt-5 mb-3 text-body-secondary">© 2017–2023</p> -->
            </form>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>