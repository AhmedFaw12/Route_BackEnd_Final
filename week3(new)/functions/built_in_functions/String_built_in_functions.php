<?php

/* 
    string functions:

    1)trim(string, charlist(optional)):string(return type):
    removes whitespaces and other predefined characters from both sides(begin , end) of a string

    paramters:
    charlist(optional): to determine which characters to remove:
    - \t -> tab
    - \n -> newline
    - " " -> white space(default)
    -\0 -> null

    2)ltrim() : removes from left side only
    3)rtrim() : removes from right side only

    4)strlen(string):int  : return length of string

    5)md5(string): string :it is an encryption function that takes a string and encrypt it
    - it is called one-way encryption because it can not be decrypted

    6)substr(string , int start_index, int length(optional)):string | false :
    -return part of a string
    -if start index is greater that length , false is returned

    7)strpos(string , string req_substring):int|false :
    
    -Find the position of the first occurrence of a substring in a string
    -return false if not found

    -note on strpos():
    -strpos may return 0 index , but 0 will give false inside if statement , so we must use !==false(not identical) operator
    - != false(not equal) will give false because 0 = false in value but they are not equal in datatype

    -example
    if(strpos("Ahmed", "a") !== false){

    }

    8)stripos(string , string req_substring):int|false:
    Find position of first occurrence of a case-insensitive string

    9)strtolower(string):string :Make a string lowercase
    
    10)strtoupper(string):string:Make a string uppercase

    11)str_replace(string search, string replace, string original_string):string  :
    
    -Replace all occurrences of the search string with the replacement string

    -it does not change the original string

    12) str_split(string, int length = 1(optional)) : array|false :

    -Convert a string to an array
    -every character in string will be an element in array

    parameters:
    length : Maximum length of the chunk.
    if i want every 5 character in string to be 1 element in array , then put length = 5

    -FALSE is returned if split_length is less than 1. If the split_length length exceeds the length of string, the entire string is returned as the first (and only) array element

    13)number_format(float $num, int $decimals = 0):string  :
    Format a number with grouped thousands

    -بيحط , بين الارقام
    
    parameters:
    decimals(optional) : how many number after decimal point

    14)strip_tags(string, string allow = null):string :
    
    -Strip HTML and PHP tags from a string
    -allow : i can determine which tag is allowed

    15) htmlspecialchars(string):string :
    - stops html tags from working and return/print them as they are in the output string

*/

#example on trim
$x = "_____hello World_______";
// $x = trim($x); // removes spaces
$x = trim($x, "_"); // removes _

echo($x),"<br>";
echo "<hr>";

#example on strlen
$x = "     hello World        ";
echo strlen($x), "<br>";//24
$x  = trim($x);
echo strlen($x), "<br>";//11
echo $x, "<br>";

echo "<hr>";

#example on md5()
$x = "hello world";
echo md5($x), "<br>";

echo "<hr>";

#example on substr():
$name = "Ahmed Ali";
echo substr($name, 0), "<br>"; // Ahmed Ali
echo substr($name, 0, 5), "<br>"; // Ahmed
echo substr($name, 6, 3), "<br>"; // Ali
echo substr($name, 6), "<br>"; // Ali
echo substr($name, -3), "<br>"; // Ali

echo "<hr>";

#example on strpos():
$name = "ahmed ali";
echo strpos($name, "x"), "<br>"; // empty(false)
var_dump(strpos($name, "x")); // false
echo "<br>";
var_dump(strpos($name, "a")); // 0
echo "<br>";

#example on strpos():
$name = "ahmed ali";
$char = "a";
if(strpos("ahmed", $char) !== false){
    echo "found <br>";
}

echo "<hr>";

#example on stripos():
$name = "ahmed ali";
var_dump(stripos($name, "A")); // 0
echo "<br>";
var_dump(stripos($name, "M")); // 2
echo "<br>";
var_dump(stripos($name, "m")); // 2
echo "<br>";
var_dump(stripos($name, "x")); // false
echo "<br>";

echo "<hr>";

#example on strtolower(), strtoupper
$name = "ahmed ali";
echo strtoupper($name),"<br>";//AHMED ALI

$name = "MOHAMED FAWZY";
echo strtolower($name),"<br>"; //mohamed fawzy

echo "<hr>";

#example on str_replace()
$msg = "Ahmed is clever, is good";
echo str_replace("is", "are", $msg) , "<br>"; //Ahmed are clever, are good
echo "<hr>";

#example on str_split()
$msg = "Ahmed is Clever";
$arr = str_split($msg);

echo "<pre>";
print_r($arr);
echo "</pre>";
/* 
 output:
 Array
(
    [0] => A
    [1] => h
    [2] => m
    [3] => e
    [4] => d
    [5] =>  
    [6] => i
    [7] => s
    [8] =>  
    [9] => C
    [10] => l
    [11] => e
    [12] => v
    [13] => e
    [14] => r
)
*/
$arr = str_split($msg, 5);
echo "<pre>";
print_r($arr);
echo "</pre>";
/* 
Array
(
    [0] => Ahmed
    [1] =>  is C
    [2] => lever
)
*/

echo "<hr>";

#example on number_format():
$num = 15023198.91;
echo number_format($num) , '<br>'; //15,023,199 , approximated
echo number_format($num,2) , '<br>'; //15,023,199.91

echo"<hr>";

#example on strip_tags()
$phrase = "hello<h1> world</h1>";
echo strip_tags($phrase), "<br>"; //hello world

echo strip_tags($phrase, "<h1>"), "<br>"; //hello
                                          //world
echo "<hr>";

#example on htmlspecialchars()
$phrase = "<h1>hello</h1> <p>php</p> ";
echo htmlspecialchars($phrase), "<br>"; //<h1>hello</h1> <p>php</p>

#example on htmlspecialchars()
$phrase = "hello<script>alert('Ahmed') </script> ";
echo htmlspecialchars($phrase), "<br>"; //hello<script>alert('Ahmed') </script>

echo "<hr>";