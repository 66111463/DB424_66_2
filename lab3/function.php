<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Function</title>
</head>
<body>
    <?php
        function a1($m, $n) {
            return $m + $n; // สร้างฟังก์ชั่นชื่อ a1 ให้มีตัวแปร m กับ n
        }
        function a2($m, $n) {
            return $m ?? "No, I can't"; // สร้างฟังก์ชั่นชื่อ a2 เพื่อใช้เงื่อนไขของ null หากพบให้ return ข้อความออกมา
        }
        $o = 5; // กำหนดค่าตัวแปร o
        $f = is_null($o) ? 'a2' : 'a1'; // ตั้งชื่อฟังก์ชั่นใหม่ในตัวแปรเพื่อดูผลลัพธ์
    ?>
    <h3>PHP___FUNCTION___RESULT</h3>
    <pre>
        echo ฟังก์ชั่นที่ประกาศไว้ในตัวแปร คือ <?php echo $f($o, 5);?> 
    </pre>
</body>
</html>