<?php

// Ahmed Fawzy  Ibrahim -  Sun& Wed (7 - 10 pm) - Assignment 1 

/***************** practice 1  ********************/
echo "Hello <br> Ahmed Fawzy <br>";
echo "<hr>";


/***************** practice 2  ********************/
echo ( -5 + (8 * 6)) . "<br>";
echo ( (55+9) % 9) . "<br>";
echo ceil(20 +  ( (-3*5) / 8) ) . "<br>";
echo  (5 + 15 / 3 * 2 - 8 % 3 ) . "<br>";

echo "<hr>";

/***************** practice 3  ********************/
echo ((25.5 * 3.5 - 3.5 * 3.5) / (40.5 - 4.5)) . "<br>";
echo "<hr>";

/***************** practice 4  ********************/
$n1 = 25;
$n2 = 39;

echo ($n1 == $n2) ? "$n1 == $n2" : (($n1 > $n2) ? "$n1 > $n2" : "$n1 < $n2") . "<br>" ;

echo "<hr>";


/***************** practice 5  ********************/
$x = 15 ; 
$y = 20; 
$z = 25;
$cnt = 0;

if($x >= 20 && (abs($y - $z) > $x)){
    $cnt++;    
}
if($y >= 20 && (abs($x - $z) > $y)){
    $cnt++;    
}
if($z >= 20 && (abs($x - $y) > $z)){
    $cnt++;    
}

if($cnt > 0){
    echo "true <br>";
}
else {
    echo "false <br>";
}
echo "<hr>";


/***************** practice 6  ********************/
$n1 = 10;
echo "Equivalent decimal number: " . octdec($n1) . "<br>";

echo "<hr>";

/***************** practice 7  ********************/
for($i = 1; $i < 100; $i++){
    if($i & 1){
        echo "$i <br>";
    }
}
echo "<hr>";


/***************** practice 8  ********************/
$sumPrime = 0;
$cnt = 0;
for($i = 2; $i < 100; $i++){
    $cnt = 0;
    for($j = 1; $j <= $i; $j++){
        if($i % $j == 0){
            $cnt++;
        }
    }
    if($cnt == 2){
        echo "$i , ";
        $sumPrime += $i;
    }
}

echo " sum of all these numbers is $sumPrime <br>";
echo "<hr>";

/***************** practice 9  ********************/
$divisibleBy3 = [];
$divisibleBy5 = [];
$divisibleBy3And5 = [];

for($i = 1; $i < 100; $i++){
    if($i % 3 == 0){
        $divisibleBy3 [] = $i;
    }

    if($i % 5 == 0){
        $divisibleBy5 [] = $i;
    }

    if($i % 3 == 0 && $i % 5 == 0){
        $divisibleBy3And5 [] = $i;
    }
}

echo "Divided By 3: <br>";
foreach($divisibleBy3 as $value){
    echo "$value ,";
}
echo "<br> <br>";

echo "Divided By 5: <br>";
foreach($divisibleBy5 as $value){
    echo "$value ,";
}
echo "<br> <br>";

echo "Divided By 3 & 5: <br>";
foreach($divisibleBy3And5 as $value){
    echo "$value ,";
}
echo "<br> <br>";

echo "<hr>";


/***************** practice 10  ********************/
$uniqueCnt = 0;
for($i = 1; $i <= 4; $i++){
    for($j = 1; $j <= 4; $j++){
        for($k = 1; $k <= 4; $k++){
            if($i != $j && $i != $k  && $j != $k){
                $uniqueCnt++;
                echo "$i $j $k <br>";
            }
        }
    }
}
echo "Total number of the three-digit-number is $uniqueCnt <br>";

echo "<hr>";



/***************** Bonus  ********************/
// sessons determine (spring , summer , autumn , winter)
$d = date("d");
$m = date("n");

echo "Today is " . $d . " / " . $m . " ";

switch ($m) {
    case 3:
        echo ($d >= 20) ? "spring" : "winter";
        break;

    case 6:
        echo ($d >= 21) ? "summer" : "spring";
        break;
    case 9:
        echo ($d >= 22) ? "autumn" : "summer";
        break;
    case 12:
        echo ($d >= 21) ? "winter" : "autumn";
        break;
        
    case 4:
    case 5:
        echo "spring";
        break;
    case 7:
    case 8:
        echo "summer";
        break;
    case 10:
    case 11:
        echo "autumn";
        break;
    case 1:
    case 2:
        echo "winter";
        break;
    default:
        echo "invalid input";    
}

echo "<hr>";