<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* สร้าง Class */
        .spades, .clubs {
            color: black;
        }
        .hearts, .diams {
            color: red;
        }
    </style>
</head>
<body>
    <?php
    $suits = ['spades', 'clubs', 'hearts', 'diams'];
    $ranks = explode(',', 'A,2,3,4,5,6,7,8,9,10,J,Q,K');
    $deck = [];
    foreach($suits as $suit) {
        foreach ($ranks as $rank) {
            $deck[] = ['suit'=>$suit, 'rank'=>$rank];
        }
    } //ใช้ foreach เพื่อทำ loop กับมาชิกทุกตัวใน Array
    

    function draw($deck) {
        //global $deck; << อาจจะใช้ตัว Global ก็ได้
        $tmp = rand(0, 51);
        $card1 = $deck[$tmp];
        unset($deck[$tmp]); //เอาไพ่ออกเพื่อไม่ให้ไพ่ใบที่สองจั่วได้ใบเดิม
        sort($deck); //เรียงไพ่ 0-50 (51 ใบ)
        $tmp = rand(0, 50);
        $card2 = $deck[$tmp];
        return[$card1, $card2];
    }
    // echo '<pre>';
    // print_r(draw($deck));
    // echo '</pre>';
    ?>
    <?php
        $cards = draw($deck);
    ?>
    <h1>ไพ่ที่ได้</h1>
    <h1>
        <span class="<?= $cards[0]['suit']//ใช้ echo แบบสั้น?>">
            <?php
                echo $cards[0]['rank'].'&'.$cards[0]['suit'].';'; //ใช้ HTML Characters Entities ใน concat
            ?>
        </span>
        +
        <span class="<?php echo $cards[1]['suit'];?>";>
            <?php
                echo "{$cards[1]['rank']}&{$cards[1]['suit']};"; //ใช้ HTML Characters Entities ใน literal string
            ?>
        </span>
    </h1>
    
</body>
</html>