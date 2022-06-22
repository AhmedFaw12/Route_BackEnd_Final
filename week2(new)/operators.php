<?php

/*
operators types:
1)arithmatic operators:
    +
    -
    *
    /
    %  (remainder)
    ** (power)

    #precedence : (), **, * / , + -

2)assignment operators:
    =
    +=
    -=
    *=
    /=
    %=
    ++ (post or pre increment)
    -- (post or pre decrement)

3) comparison operators: its result is true or false:
    == (equality): it will compare value only not datatype so "10" is equal to 10 in value
    
    === (identical) : it will compare value and datatype so "10" is not identical to 10  
    
    <> or !=(not equility) : compare on value only

    !== (not identical) : compare value , datatype

    >
    >=
    <
    <=

4) logical operations : if i want to group multiple conditions :
    
    and  &&(short and) : all conditions must be true
    -it is called short because if the first condition is false , it will not check the rest of conditions

    or || (short or): only one condition may be true
    --it is called short because if the first condition is true , it will not check the rest of conditions

    ! (reverse the condition)

    xor : a xor b true if either a or b is true ,but not both


    precendence : && , then ||

5) string operators :
    1) . (concat operator)
        $a = "hello ";
        $b = $a . "world!" // b = hello world

    2) .= 
        $a = "hello ";
        $a .= "world"; // a = hello world

6) ?? (null coalescing operator):  
    
    syntax :
    $x = expr1 ?? expr2
    
    explanation:
    -the value of $x is expr1 if expr1 exists and is not null
    -if expr1 does not exist or is null, the value of $x is expr2
    -introduced in php 7

    -it expr1 is empty string ,then it is not null, so value of $x is expr1

7) ? (ternary operator):
    
    syntax:
    $x = expr1 ? expr2 : expr3 

    explanation:
    -the value of $x is expr2 if expr1 is true
    -the value of $x is expr3 if expr1 is false


8)isset(var_name) :Determine if a variable is declared and is different than NULL 
    - if there is a variable
    - $var_name = "" gives true
    - gives false :
        - if var_name is not defined
        - if var_name == null

9)empty($var_name):Determine whether a variable is empty
-returns true:
    -if $var_name is empty string ""
    -if $var_name is not defined
    -if $var_name == null

10) array operators


-in php if i echo true , it will print 1 
-in php if i echo false , it will print empty(not print anything)


*/

#examples on arithmatic operators
$x = 10;
$y = 3;

$z = $x + $y;
echo '$z = ' ,$z ,"<br>"; //output: $z = 13

echo "$x + $y = " , ($x + $y), "<br>";//output : 10 + 3 = 13
echo "$x - $y = " , ($x - $y), "<br>";
echo "$x * $y = " , ($x * $y), "<br>";
echo "$x / $y = " , ($x / $y), "<br>";
echo "$x % $y = " , ($x % $y), "<br>";
echo "$x ** $y = " , ($x ** $y), "<br>";

echo "$x + 2 * $y = " , ($x + 2 * $y), "<br>";

echo "($x + 2) * $y = " , (($x + 2) * $y), "<br>";

echo "<hr>";

//////////////////////////////////////////////////////////////
#examples on assignment operators
$y = 5;

$y = $y + 5; // 10
$y += 10; // 20

echo "$y <br>"; // 20

$x -= $y; // -10
echo "$x <br>"; 

#example on post increment
$i = 1;
echo '$i++ = ' , $i++, "<br>"; //1 
echo "$i <br>";//2


#example on pre increment
$y = 20;
echo ++$y, "<br>"; //21

echo --$i , "<br>"; // 1

#example 
$i = 5;
$x = 10;
$y = 3;

$z = $x - --$y; 
echo "x = $x, y = $y, z = $z<br>";// x=10 ,y=2, z=8

$z = $x-- - --$y; 
echo "x = $x, y = $y, z = $z<br>";// x=9 ,y=1, z=9


#example
$z -= $y++;
echo "x = $x, y = $y, z = $z<br>";// x=9 ,y=2, z=8

#example
$z = ++$x - --$y;
echo "x = $x, y = $y, z = $z<br>";// x=10 ,y=1, z=9

#example
$y = $x++ ;
echo "x = $x, y = $y, z = $z<br>";// x=11 ,y=10, z=9

#example
$y += $x++;
echo "x = $x, y = $y, z = $z<br>";// x=12 ,y=21, z=9

#example
$y -= --$x;
echo "x = $x, y = $y, z = $z<br>";// x=11 ,y=10, z=9
echo "<hr>"; 
//////////////////////////////////////////////////////////////

#examples on comparison operators

#example on ==
$x = '10';

echo $x == 10 , "<br>"; //1 
var_dump(($x == 10)); //true
echo "<br>";

#example on ===
$x = '10';
var_dump($x === 10);
echo "<br>";

$x = 10;
var_dump($x === 10);
echo "<br>";

#example on != or <>
$x = 10;
var_dump(($x != 10)); //false
echo "<br>";
var_dump(($x <> 10)); //false
echo "<br>";

#example on !==
$x = "10";
var_dump(($x !== 10)); //true , they are not identical
echo "<br>";

echo "<hr>";
////////////////////////////////////////////////////////////////

#example on logical operators
$x = 10;
var_dump(! $x==10); // false because of the !

echo "<br>";

var_dump( $x > 5 && $x < 10 && 10 > 5); //false (all conditions must be true)

echo "<br>";
var_dump( $x > 5 || $x < 10 || 10 > 5); // true
echo "<br>";


var_dump( $x > 5 && $x < 10 || 10 > 5); // true(false || true)
echo "<br>";

var_dump( 10 > 5 ||$x > 5 && $x < 10 ); // true
echo "<br>";

#example on short and
$x = 10;
var_dump(--$x > 5 && $x < 10); // true
echo "$x <br>"; //9

var_dump($x > 15 && ++$x < 10); // false , it will not make ++$x 
echo "$x <br>"; //9

var_dump($x > 5 && ++$x <= 10); // true , it will make ++$x
echo "$x <br>"; //10

var_dump($x > 5 || ++$x < 10); // true , it will not check or make ++$x
echo "$x <br>"; //10

echo "<hr>";

////////////////////////////////////////////////////////////////

#example on null coalescing (??)
$data = null;
echo $data ?? "no data" , "<br>"; //no data

#example on null coalescing (??)
$data = 'hello world';
echo $data ?? "no data" , "<br>"; //hello world

#example on null coalescing (??)
$myName = ""; //not null
echo $myName ?? "no data" , "<br>"; // empty 

#example on null coalescing (??)
//$name = ""
echo $name ?? "no data" , "<br>"; // no data

//////////////////////////////////////////////////////////////
#example on ternary operator (?)
$age = 30;

$msg = ($age >= 60) ? "retired" : "working";
echo $msg , "<br>";
echo"<hr>";


#example on isset():
if(isset($yourName)){
    echo "welcome" ,($yourname), "<br>";
}else{
    echo "name is not defined <br>";
}


#example on isset():
$yourName = "";
if(isset($yourName)){
    echo "welcome" ,($yourname?? " sir"), "<br>";
}else{
    echo "name is not defined <br>";
}
echo"<hr>";

#example on empty():
$yourName = "";
if(!empty($yourName)){
    echo "welcome" ,($yourname), "<br>";
}else{
    echo "name is empty <br>";
}
echo"<hr>";
