<?php

/*
    - in php i can't define 2 functions with same name in same file

    
*/

#define function
function say_hello(){
    echo "hello<br>";
}
say_hello();

#example on function with arguments
function say_hello_user($name){
    echo "hello $name<br>";
}
say_hello_user("Ahmed");
say_hello_user("2005-05-11");
// say_hello_user(); // fatal error : Too few arguments to function 


#example on function with default arguments
function say_hello_user_default($name = ""){
    echo "hello $name<br>";
}


//function overloading
say_hello_user_default("doaa");
say_hello_user_default("ahmed");
say_hello_user_default(15);
say_hello_user_default();

//example on function with return
function add($x, $y){
    return $x + $y;
}

$rslt = add(15,19);
echo "result is $rslt<br>";



