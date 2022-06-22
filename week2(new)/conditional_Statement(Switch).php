<?php

/*
    -Switch : used when all cases check on the same variable and all conditions contain only = 
    
    -switch is better in performance than if because if statement check conditions line by line (if not cond1 check cond2 .......), while switch statement jump to the correct condition directly(using something called jump table)

    syntax:
    switch ($variable) {
    case 'value':
        # code...
        break;
    
    default:
        # code...
}
*/

#example on switch
$name = "Ahmed";
switch($name){
    case "kareem":
        echo "hello kareem";
        break;
    case "Ahmed":
        echo "hello Ahmed";
        break;
    default:
        echo "i don't know you";
}

echo "<hr>";

#example
$grade = 'C';
switch($grade){
    case 'A':
        echo "Excellent<br>";
        break;
    case 'B':
        echo "V.Good<br>";
        break;
    case 'C': case 'D':
        echo "pass<br>";
        break;
    case 'F': case 'E':
        echo "Fail<br>";
        break;
    default:
        echo "Invalid grade<br>";
        
}

#example :determine the weather season
/* 
    months 12, 1, 2 : winter
    winter start on >= 21/12
    
    months 3, 4, 5 : Spring
    Spring start on >= 21/3
    
    months 6, 7, 8 : summer
    summer start on >= 21/6
    
    
    months 9, 10, 11 : fall
    fall start on >= 21/9
    
    
*/
$month = date('m');
$day = date('d');

switch($month){
    case 12:
        if($day < 21){
            echo "fall<br>";
            break;
        }//else it will continue to print winter

    case 1 : case 2:
        echo "Winter<br>";
        break;
    case 3: 
        if($day < 21){
            echo "Winter<br>";
            break;
        }//else it will continue to print spring
    case 4 : case 5:
        echo "spring<br>";
        break;
    case 6: 
        if($day < 21){
            echo "spring<br>";
            break;
        }//else it will continue to print summer
    case 7 : case 8:
        echo "summer<br>";
        break; 
    case 9: 
        if($day < 21){
            echo "summer<br>";
            break;
        }//else it will continue to print fall
    case 10 : case 11:
        echo "fall<br>";
        break;
}


//search for match case (in php 8)