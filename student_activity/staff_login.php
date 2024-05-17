<?php
  session_start();  
  require 'db_conn.php';

  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "select * from staff where email=?";
    try {
      $stm = $conn->prepare($sql);
      $stm->bind_param('s', $email);
      $stm->execute();
      $result = $stm->get_result();
      if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
          $_SESSION['user'] = ['id'=>$row['id'], 'fullname'=>$row['fullname']];
          header('location: staff_main.php');
          exit();
        }
        else {
          echo 'Password is not correct.';
        }
      }
      else {
        echo 'Email does not exist.';
      }
    }
    catch (Execption $e) {
      echo $e;
    }
  }
  $conn->close();
//   $_SESSION['user'] = ['id'=>'000001', 'fullname'=>'มงคล สมรส'];
//   header('location: staff_main.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login to Staff Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
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
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
        <form method="post">
            <h1 class="h3 mb-3 fw-normal">Staff Admin Login</h1>

            <div class="form-floating">
                <input name="email" type="email" class="form-control" id="floatingEmail" placeholder="Email address">
                <label for="floatingEmail">Email address</label>
            </div>
            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <button name="submit" class="btn btn-primary custom-btn w-100 py-2" type="submit">Login</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="staff_enroll.php"
                    class="link-danger">Enrollment</a></p>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>