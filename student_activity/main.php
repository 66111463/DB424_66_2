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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Student Activity</title>
    <script>
        function enroll(id) {
            fetch('enroll.php?id='+id)
            .then(response=>response.json())
            .then(data=>{
                //alert(data);
                if (data['status'] == 'error') {
                    alert(data['message']);
                }
                else {
                    alert('ลงทะเบียนสำเร็จ');
                }
                location.reload();
            });
            //fetch คือ Ajax หรือ Asynchronous ที่ไม่จำเป็นต้องรอให้เสร็จสิ้นคำสั่ง แต่จะใช้ then เป็นคนบอกว่าเสร็จคำสั่ง โดยถ้าอยากให้รอให้ใช้คำสั่ง await ควบคู่
            //เพื่อไม่ให้ออกจากหน้าเดิม
            //location.href='enroll.php'; //-----> ไม่ควรใช้ redirect ไปหน้าใหม่
            //alert(id);
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
        <h1 class="display-6">Activities</h1>
        <table class="table table-striped">
            <tr>
                <th>กิจกรรม</th>
                <th>ภาคการศึกษา</th>
                <th>ประเภท</th>
                <th>เริ่ม</th>
                <th>สิ้นสุด</th>
                <th>ที่คงเหลือ</th>
                <th></th>
            </tr>
            <?php 
            require 'db_conn.php';
            //$sql = "select A.id, A.name, semester, edu_year, start, end, C.name cat_name, seats 
            //        from activities A join categories C on A.cat_id=C.id
            //        where seats > 0 and
            //        not exists (
            //            select act_id 
            //            from enrollments 
            //            where stu_id = '{$_SESSION['user']['id']}' and act_id=A.id)"; //ตัวเลือกโดยใช้ subquery ใน where เป็น not exists
             $sql = "select A.id, A.name, semester, edu_year, start, end, C.name cat_name, seats 
                    from activities A join categories C on A.cat_id=C.id
                    where seats > 0 and
                    A.id not in (
                        select act_id 
                        from enrollments 
                        where stu_id = '{$_SESSION['user']['id']}')"; //ตัวเลือกโดยใช้ subquery ใน where เป็น not in
            $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['semester']}/{$row['edu_year']}</td>";
                    echo "<td>{$row['cat_name']}</td>";
                    echo "<td>{$row['start']}</td>";
                    echo "<td>{$row['end']}</td>";
                    echo "<td class='text-end'>{$row['seats']}</td>";
                    echo "<td><button class='btn btn-primary btn-sm'
                            onclick='enroll({$row['id']})'>ลงทะเบียน</button></td>";
                    echo '</tr>';
                }
            ?>
        </table>
    </div>
    <!-- ยินดีต้อนรับ คุณ<?php #echo $_SESSION['user']['fullname'];?>
    <h3><a href="signout.php">Signout</a></h3> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>