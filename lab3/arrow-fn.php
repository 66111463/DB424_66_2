<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Arrow Function</title>
</head>
<body>
    <?php
        $a1 = fn($m, $n) => $m + $n; // สร้างฟังก์ชั่นชื่อ a1 ให้มีตัวแปร m กับ n โดยกำหนดจาก Arrow Function

        function a2($m, $n) {
            return $m ?? "No, I can't"; // สร้างฟังก์ชั่นชื่อ a2 เพื่อใช้เงื่อนไขของ null หากพบให้ return ข้อความออกมา
        }
        echo '$o = null<br>'; // <br> คือ break line เพื่อขึ้นบรรทัดใหม่
        $o = null; // กำหนดค่าตัวแปร o
        // $f = is_null($o) ? 'a2' : 'a1';
        $f = is_null($o) ? 'a2' : $a1; // ตั้งชื่อฟังก์ชั่นใหม่ในตัวแปรเพื่อดูผลลัพธ์
        $a2 = explode(",", "apple,pear,peach");
    ?>
    <h3>PHP___FUNCTION___RESULT</h3>
    <pre>
echo ฟังก์ชั่นที่ประกาศไว้ในตัวแปร คือ <?php echo $f($o, 5);
        echo '<br>';
        echo '<br>';

        echo $a2[0].'<br>';
        echo $a2[1].'<br>';
        echo $a2[2].'<br>';
        echo '<br>';

        $foods = ['morning'=>'โจ๊ก', 'lunch'=>'ข้าวผัด', 'dinner'=>'ชาบู'];
        echo $foods['morning'].'<br>';
        echo $foods['lunch'].'<br>';
        echo $foods['dinner'].'<br>';
        echo '<br>';

        var_dump($foods);
        echo '<br>';

        $multiarray = [[1,2,3], ['a','b',['c', 5]]];
        // var_dump($multiarray);
        //print_r($multiarray); //แล้วแต่คนชอบว่าจะใช้ var_dump หรือ print_r
        //หรือ
        echo '<pre>';
            print_r($multiarray);
        echo '</pre>';
        echo $multiarray[1][0]; // สั่งดูตัว a
        echo '<br>';
        echo $multiarray[1][2][1]; // สั่งดูเลข 5
        echo '<br>';

        ksort($foods);
        echo '<pre>';
        print_r($foods);
        echo '</pre>';
        ?> 
        <?php
            $array = array('a', 'b', 'c');
            $count = count($array);
    
            for ($i = 0; $i < $count; $i++) {
            echo "i:{$i}, v:{$array[$i]} <br>";
            }
        ?> 
        <?php
            $colors = array('red', 'blue', 'green');

            foreach ($colors as $i=>$color) {
                echo "{$i} Do you like $color? <br>";
            }
        ?> 
    </pre>
    
</body>
</html>