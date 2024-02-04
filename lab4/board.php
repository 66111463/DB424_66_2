<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- > COMMENT คำสั่ง <-->
    <style>
        * { /* '*' คือ ทุก element */
            box-sizing: border-box;
        }
        table {
            border-spacing: 0;
            border: 1px solid black;
        }
        td {
            width: 50px;
            height: 50px;
        }
        .black {
            background-color: black;
            /* .<class> */
        }
        .white {
            background-color: white;
        }
    </style>
</head>
<body>
    <table> 
        <?php //loop for เป็น loop ทีั่รู้ว่าต้องทำซ้ำกี่รอบใน lab นี้จะใช้ for loop
            // loop while เป็น loop ที่จะทำเรื่อยๆ ตราบใดที่เงื่อนไขมีค่าเป็นจริง (Not null)
            // <table> เป็นแท็กที่ใช้กำหนดเริ่มต้นและปิดตาราง
            // <tr> เป็นแท็กที่ใช้กำหนดเริ่มต้นและปิดแถวในตาราง
            // <td> เป็นแท็กที่ใช้กำหนดเริ่มต้นและปิดเซลล์ในตาราง (ข้อมูล)
            for ($i=0; $i <8; $i++) {
                echo '<tr>';
                for ($j=0; $j <8; $j++) {
                    // ($i+$j)%2 == 0
                    // echo "<td>{$i}, {$j}</td>";
        ?>
        <td class="<?php echo ($i + $j) % 2 != 0 ? 'white' : 'black';?>"></td>
        <?php
                }
                echo '</tr>';
            }
        ?>
    </table>
</body>
</html>