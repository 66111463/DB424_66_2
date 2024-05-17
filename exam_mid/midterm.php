<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search product by category</title>
</head>
<body>
<?php

?>
  <form>
    <label for="category">
      <select name="category" id="category">
        <?php
          // ทำข้อสอบหลังจาก comment ของแต่ละข้อ
          // 1. (2 คะแนน) เขียนคำสั่ง php เพื่อติดต่อฐานข้อมูล northwind
          $servername = "db403-mysql";
          $database = "northwind";
          $username = "root";
          $password = "P@ssw0rd";
          try {
            $conn = new mysqli($servername, $username, $password, $database);
          }
          catch (Exception $e) {
            die("Connection failed");
          }
          echo "Connected successfully";

          // 2. (3 คะแนน) เขียนคำสั่ง php เพื่อดึงข้อมูล CategoryName และ CategoryID จากตาราง categories
          $sql = "SELECT CategoryName, CategoryID FROM categories";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) {
            echo '<li>'.$row['CategoryName'].'</li>';
            }      
          // 3. (5 คะแนน) เพิ่ม element option ใน element select เพื่อแสดงตัวเลือกเป็น CategoryName และค่าที่ได้เป็น CategoryID
          // ตัวอย่างการเพิ่ม element options
          // <option value="CategoryID">CategoryName</option>
          ?>
        <option value="CategoryID">CategoryName</option>
      </select>
          </label>
    <input type="submit" value="Search" name="submit">
  </form>
</body>
</html>