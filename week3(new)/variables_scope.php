<?php
/*
Variables Scope:
    1)global Scope
    2)local scope 
    3)static scope
    
    1)global(page) scope : a variable outside a function has a global scope and can only be accessed outside a function
    - has page life time

    gloabl keyword:is used to access a global variable from within a function

    2)local(function) scope : a variable declared within a function has a local scope and can only be accessed within that function
    -has function lifetime

    3)static keyword: normally , when a function is completed/executed , all of its variables are deleted. however, sometimes we want a local variable not to be deleted. we need it for a further job.

    - static variable has a page lifetime but no one can access it except within the function
*/

#example on global variable
$name = "ahmed"; //global scope
function say_hello(){
    echo "variable name inside function is :$name<br>";
}

say_hello();
echo"<hr>";
/*
Warning: Undefined variable $name in C:\xampp\htdocs\week3(php)\variables_scope.php on line 20

variable name inside function is :
*/ 


#example on global keyword:
$x = 5;
$y = 10;
function demo(){
    global $x, $y; // i can't change x or y in the same line of global keyword 
    // global $x = 10; //worng , error
    $y = $x + $y;
}
demo();
echo $y, "<br>"; //15
echo"<hr>";


#example on local scope
function myTest(){
    $x =5; //local scope
    echo $x, "<br>";
}

myTest(); // 5
echo $x ,"<br>";
echo"<hr>";
/*
output:
Warning: Undefined variable $x in C:\xampp\htdocs\week3(php)\variables_scope.php on line 38

-- empty 
*/

#example on static keyword:
function counter(){
    static $i = 0;//function scope - page life time
    $i++;
    echo $i, "<br>";
}

counter(); //1
counter(); //2
counter(); //3

$i = 50; //(global scope)another variable with same name i has a value of 50 and not seen by function

counter(); //4 because i inside is different from i outside
counter(); //5

echo $i, "<br>";
echo"<hr>";
