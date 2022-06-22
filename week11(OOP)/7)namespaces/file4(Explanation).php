<?php
/*
-->namespaces: 
    -Namespaces are virtual containers that solve two different problems:
        1)They allow for better organization by grouping classes that work together to perform a task
        
        2)They allow the same name to be used for more than one class
    
    -Namespaces are declared at the beginning of a file using the namespace keyword

    -use keyword is used to use the namespace:
        use namespace_name\class_name;
        echo Cat::says(), "<br>";

    or:
        use namespace_name;
        echo namespace_name\Cat::says();

*/

use foo\Cat;
use bar\Dog;
use animate\Animal;

require ("file1.php");
require ("file2.php");
require ("file3.php");

echo foo\Cat::says(), "<br>";
echo Dog::says(), "<br>";
echo Animal::breathes(), "<br>";