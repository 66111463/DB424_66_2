<?php
    session_start();  
    require 'db_conn.php';

    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "insert into
        staff (id, fullname, email, password)
        values (?, ?, ?, ?)";

        try {
            $stm = $conn->prepare($sql);
            $stm->bind_param('ssss', $id, $fullname, $email, $password);
            $stm->execute();
            $_SESSION['user'] = ['id'=>$id, 'fullname'=>$fullname];
            header('location: staff_main.php');
            exit();
        }
        catch (Exception $e) {
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
        <title>Staff Enrollment</title>
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

            .form-signin input[id="floatingPassword2"] {
                margin-bottom: 10px;
                border-bottom-left-radius: 6px;
                border-bottom-right-radius: 6px;
            }
            /* Custom button styling */
            .custom-btn {
                background-color: orange;
                border-color: orange;
            }

            .custom-btn:hover {
                background-color: darkorange;
                border-color: darkorange;
            }
        </style>
        <script>
            function confirmPassword() {
                let p1 = document.getElementById('floatingPassword').value;
                let p2 = document.getElementById('floatingPassword2').value;
                if (p1 != p2) {
                    alert('Password not match.');
                    event.preventDefault();
                }
            }
        </script>
    </head>
    <body class="d-flex align-items-center py-4 bg-body-tertiary">
        <main class="form-signin w-100 m-auto">
            <form method="post" onsubmit="confirmPassword()">
                <h1 class="h3 mb-3 fw-normal">Fill in your information</h1>
                <?php
                    if (isset($error)) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                ?>
                <div class="form-floating">
                    <input name="id" type="text" class="form-control" id="floatingStaffID" placeholder="Staff ID" requried>
                    <label for="floatingStaffID">Staff ID</label>
                </div>
                <div class="form-floating">
                    <input name="fullname" type="text" class="form-control" id="floatingFullname" placeholder="Fullname" requried>
                    <label for="floatingFullname">Fullname</label>
                </div>
                <div class="form-floating">
                    <input name="email" type="email" class="form-control" id="floatingEmail" placeholder="Email address" requried>
                    <label for="floatingEmail">Email address</label>
                </div>
                <div class="form-floating">
                    <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" requried>
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword2" placeholder="Confirm Password" requried>
                    <label for="floatingPassword2">Confirm Password</label>
                </div>
                
                <button name="submit" class="btn btn-primary custom-btn w-100 py-2" type="submit">Enrollment</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="staff_login.php" class="link-danger">Login</a></p>
            </form>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>