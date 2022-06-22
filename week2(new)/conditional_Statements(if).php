<?php


echo "<p>Hello</p>";

#example on if
$age = 15;
if($age >= 16) echo "<p>welcome</p>";

echo "<p>Good Bye</p>";

#example on if else
if($age >= 16){
    echo "<p>welcome</p>";
}else{
    echo "<p>good bye</p>";
}

echo "<hr>";

#example on if else if 
$d = 75;
if($d < 50) echo "fail";
else if($d < 65) echo "pass";
else if($d < 75) echo "good";
else if($d < 85) echo "very good";
else  echo "Excellent";

echo "<hr>";

#example on nested if
$d = 46;
if($d < 50){
    echo "fail";
    if($d > 45) echo "<br>can raise the degree";
}
    
else if($d < 65) echo "pass";
else if($d < 75) echo "good";
else if($d < 85) echo "very good";
else  echo "Excellent";

echo "<hr>";

#example 
$grade = "A";
if($grade == 'A') echo "Excellent";
else if($grade == 'B') echo "V.Good";
else if($grade == 'C' || $grade == 'D') echo "pass";
else if($grade == 'F' || $grade == 'E') echo "Fail";
else echo "Invalid Grade";

/*
    conditional assignments operators:
   1) ? (ternary operator):
    
    syntax:
    $x = expr1 ? expr2 : expr3 

    explanation:
    -the value of $x is expr2 if expr1 is true
    -the value of $x is expr3 if expr1 is false

    2) ?? (null coalescing operator):  
    
    syntax :
    $x = expr1 ?? expr2
    
    explanation:
    -the value of $x is expr1 if expr1 exists and is not null
    -if expr1 does not exist or is null, the value of $x is expr2
    -introduced in php 7
*/


#example on null coalescing (??)
$data = null;
echo $data ?? "no data" , "<br>"; //no data

#example on null coalescing (??)
$data = 'hello world';
echo $data ?? "no data" , "<br>"; //hello world


//////////////////////////////////////////////////////////////
#example on ternary operator (?)
$age = 30;

$msg = ($age >= 60) ? "retired" : "working";
echo $msg , "<br>";