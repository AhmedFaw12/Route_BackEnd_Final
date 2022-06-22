<?php

/*
    -variables of php are stored in the memory of server

    - variables of js are stored in the memory of client(memory that browser use)

    -Variable naming conventions:

        -can start name with _
        
        -can not start name with number , but i can write number anywhere else

        - if name consist of multiple parts , we can use camelCase 

    - variable is stored in memory when i store a value in it

    -difference between single quotes '' and double quotes "":
        - when i write variable name inside double quotes "" , its values is printed

        - when i write variable name inside single quotes '' , its name is printed
    
    -var_dump() :built-in function prints the datatype and value of variable

    -datatypes in php:
        -int
        -float
        -string
        -bool
        -array
        -object

    -In PHP : datatype of variables can change during execution of the program

    - unset() : built-in-function to remove a variable from memory, if i used the removed variables it will give me error undefined variable(variable doesn't exist)

    - $var_name = null (variable exists but it becomes empty, null)

    -we can use expression :which means instead of writing <?php echo ...... ?> inside html , we can just replace it with <?= ..... ?>

    - expression is just used with echo only

    <? ?> is called scriplets
*/

#example on variables
$name = "ahmed";
echo "Welcome ", $name , "<br>";

#example on printing variable inside double quotes ""
echo "Welcome $name <br>"; //output : ahmed

#example on printing variable inside single quotes ''
echo 'Welcome $name <br>'; // output : $name

#example on bool datatype
$flag = true;
var_dump($flag);

#example on array
$names = [];
var_dump($names);
echo "<br>";

#example on array
$names = ["ahmed", "sara"];
var_dump($names);
echo "<br>";

#example on unset()
unset($names);
// var_dump($names); //error:undefined variable
echo "<br>";

#example on empty the variable
$name = null;
var_dump($name);
echo "<br>";