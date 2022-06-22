<?php
/*
1)is_integer($value):bool 
        or
  is_int($value):bool :

  -Find whether the type of a variable is integer

2)is_float($value):bool  :
    or 
  is_double($value):bool :
Find whether the type of a variable is float    

3)is_numeric($value):bool :
    Finds whether a variable is a number or a numeric string(string that contains numbers only)

4)is_string() : Find whether the type of a variable is string

5) is_array(): Finds whether a variable is an array
*/

#examples
$price = 4;
echo is_int($price) ,"<br>";//1

$car = "bmwX6";
var_dump( is_numeric($car)); // false

echo"<br>";

$price = 4;
var_dump( is_numeric($price));//true

