<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Fundamental 1</title>
</head>
<body>
    <?php
        $a = 10;
        $b = 2.5;
        $c = 'Hello';
        $d = 'World';
        const MY_VAL = 'xxx';
        $words = 'apple banana orange';
        $space1 = strpos($words,' ');
        $space2 = strpos($words,' ', $space1 + 1);
    ?>
    <h3>ผลการทำงานใน PHP</h3>
    <pre>
        $a = <?php echo $a; /* เนื่องจากการเขียนใน Pre-defined tag หากมี 
            php script หลายคำสั่ง และต้องการให้ขึ้นบรรทัดให้ 
            ต้องมี whitespace ต่อท้ายด้วย*/ ?> 
        $b = <?= $b; // เป็นคำสั่ง echo เช่นเดียวกับด้านบนในรูปแบบย่อ ?> 
        $c = '<?php echo $c;?>' 
        $d = '<?php echo $d;?>' 
        ##########
        $a + $b จะมีค่าเป็น <?php echo $a + $b;?> 
        $c.' '.$d จะมีค่าเป็น <?php echo $c.' '.$d;?> 
        ค่าคงที่ของ MY_VAL คือ <?php echo MY_VAL; //ค่าตัวแปรคงที่ ?> 
        ##########
        $words คำที่ 1 คือ <?php echo substr($words, 0, $space1 - 0);?> 
        $words คำที่ 2 คือ <?php echo substr($words, ++$space1, $space2 - $space1);?> 
        $words คำที่ 3 คือ <?php echo substr($words, ++$space2);?> 
        ตัวอักษรที่สุ่มได้จาก $words คือ "<?php echo substr($words, rand(0, strlen($words) -1 ), 1);?>" 
    </pre>
    <?php
        $x = 0;
        try { 
            if ($x == 0) throw new Exception("Error Processing Request", 1);
            echo 5 / $x;
        }
        catch (Exception $e) {
            echo $e.'</br>';
            $x = 1;
            echo 5 / $x;
        }
    ?>
</body>
</html>