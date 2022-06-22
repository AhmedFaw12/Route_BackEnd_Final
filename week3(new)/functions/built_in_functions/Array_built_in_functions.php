<?php 

/* 
    array functions:
    1)array_push(array, val1, val2, ......) :
    Push one or more elements onto the end of array
	
	-or we can use :example :(also add elements onto the end of array)
		$cart = array();
		$cart[] = 13;
		$cart[] = 14;

    2)array_pop(&$array):
    
    -Pop the element off the end of array
    
    -returns the last value of array. If array is empty (or is not an array), null will be returned.

    3)count($array) :Counts all elements in an array and returns it

    4)array_sum(array):int|float :
    -Calculate the sum of values in an array

    5)array_values(array):array  :
    -Return all the values of an array
    -return an array : an indexed array of values

    6)array_keys(array, value(optional), strict(optional)):array  :
    
    -return An array containing keys.
    -parameters:
        -value (optional): If specified, then only keys containing these values are returned.
        -strict :Determines if strict comparison (===) should be used during the search.
            -if true is set then 5 not same as "5"
            -if false is set(default) then 5 is same as "5"
    
    7)array_column(array, string|int column_key):array  :
    
    -A multi-dimensional array (record set) from which to pull a column of values
    -Return the values from a single column in the input array

    returns an array

    parameters:
    
    -column_key :This value may be the integer key of the column you wish to retrieve, or it may be the string key name for an associative array.

    8)in_array(searched_value, array, bool strict = false):bool  :
    -Checks if a value exists in an array

    -return true if searched_value is found in the array, false otherwise.

    -parameters:
    -strict (optional):If the third parameter strict is set to true then the in_array function will also check the types of the searched_value in the array.

    9)array_search(searched_value, array, bool strict = false):string|int|false

    -Searches the array for a given value and returns the first corresponding key or index if successful

    -If searched_value is found in array more than once, the first matching key is returned. To return the keys for all matching values, use array_keys with the optional search_value parameter instead.

    -parameters:
    -strict (optional):If the third parameter strict is set to true then the in_array function will also check the types of the searched_value in the array.

    10)array_slice(array ,int start_index, int length(optional) ) : array  :

    -Extract a slice of the array
    -if the length not determined , then it will return from start_index to the end of the array

    11)array_intersect(array, array2, array3 ,...):array

    -Computes the intersection of arrays and return the intersections in an array

    12)array_key_exists(int|string key, array):bool
    -Checks if the given key or index exists in the array

    13)sort(&array):
    -sort indexed arrays in ascending order
    14)rsort(&array):
    -sort indexed arrays in descending order
    15)asort(&array):
    -sort associative arrays in ascending order, according to the value
    16)arsort(&array):
    -sort associative arrays in descending order, according to the value
    17)ksort(&array):
    -sort associative arrays in ascending order, according to the key
    18)krsort(array):
    -sort associative arrays in descending order, according to the key

    19)shuffle(&array):Shuffle an array

    20)array_unique(array):array  : 
    -Removes duplicate values from an array

    21)array_splice(&array, int start_index, int length(optional),replacement(optional)):array

    -Remove a portion of the array and replace it with something else

    -return array — the array consisting of the extracted elements.

*/
#example on array_push()
$degrees = [8,9,7,6];
array_push($degrees, 99);
echo "<pre>";
print_r($degrees);
echo "</pre>";
/*
Array
(
    [0] => 8
    [1] => 9
    [2] => 7
    [3] => 6
    [4] => 99
)
*/
$a = [
    "a" => "red",
    "b" => "green"
];
array_push($a, "blue", "yellow");
echo "<pre>";
print_r($a);
echo "</pre>";
/*
Array
(
    [a] => red
    [b] => green
    [0] => blue
    [1] => yellow
)
*/

echo"<hr>";

#example on array_pop()
$degrees = [8,9,7,6];

echo array_pop($degrees); //6
echo "<pre>";
print_r($degrees);
echo "</pre>";
echo"<hr>";
/*
Array
(
    [0] => 8
    [1] => 9
    [2] => 7
)
*/
#example on count():
$degrees = [8,9,7,6];
echo count($degrees), '<br>';//4
echo"<hr>";

#example on array_sum()
$degrees = [8,9,7,6];
echo array_sum($degrees),'<br>'; //30
echo"<hr>";

$a = [
'a'=>10,
'b'=>20,
'c'=>30
];
echo array_sum($a),'<br>'; //60
echo"<hr>";



#example on array_values()
$a = [
"name" => "ahmed",
"age" => 41,
"country" =>"Egypt"
];
echo "<pre>";
$arr = array_values($a);
print_r($arr);
echo "</pre>";
/*
Array
(
    [0] => ahmed
    [1] => 41
    [2] => Egypt
)
*/
$sales = [
    "ali" => ["jan" => 8000, "feb" => 9000, "mar" => 12000],
    "dina" => ["jan" => 7000, "feb" => 12000, "mar" => 15000],
    "sara" => ["jan" => 9000, "feb" => 4000, "mar" => 11000],
    "mona" => ["jan" => 11000, "feb" => 8000, "mar" => 9000],
];

echo "<pre>";
$arr = array_values($sales);
print_r($arr);
echo "</pre>";

echo"<hr>";
/* 
Array
(
    [0] => Array
        (
            [jan] => 8000
            [feb] => 9000
            [mar] => 12000
        )

    [1] => Array
        (
            [jan] => 7000
            [feb] => 12000
            [mar] => 15000
        )

    [2] => Array
        (
            [jan] => 9000
            [feb] => 4000
            [mar] => 11000
        )

    [3] => Array
        (
            [jan] => 11000
            [feb] => 8000
            [mar] => 9000
        )

)
*/

#example on array_keys():
$a = [10, 20,30,"10"];
echo "<pre>";
print_r (array_keys($a)); 
echo "</pre>";
/*
Array
(
    [0] => 0
    [1] => 1
    [2] => 2
    [3] => 3
)
*/

echo "<pre>";
print_r (array_keys($a,"10")); 
echo "</pre>";
/*
Array
(
    [0] => 0
    [1] => 3
)
*/

echo "<pre>";
print_r (array_keys($a,"10", true)); 
echo "</pre>";
/*
Array
(
    [0] => 3
)
*/

#another example on array_keys
$sales = [
    "ali" => ["jan" => 8000, "feb" => 9000, "mar" => 12000],
    "dina" => ["jan" => 7000, "feb" => 12000, "mar" => 15000],
    "sara" => ["jan" => 9000, "feb" => 4000, "mar" => 11000],
    "mona" => ["jan" => 11000, "feb" => 8000, "mar" => 9000],
];

echo "<pre>";
print_r (array_keys($sales)); 
echo "</pre>";
echo"<hr>";
/*
Array
(
    [0] => ali
    [1] => dina
    [2] => sara
    [3] => mona
)
*/

#example on array_column()

$sales = [
    "ali" => ["jan" => 8000, "feb" => 9000, "mar" => 12000],
    "dina" => ["jan" => 7000, "feb" => 12000, "mar" => 15000],
    "sara" => ["jan" => 9000, "feb" => 4000, "mar" => 11000],
    "mona" => ["jan" => 11000, "feb" => 8000, "mar" => 9000],
];
$janArr = array_column($sales, "jan");
echo "<pre>";
print_r ($janArr); 
echo "</pre>";
echo"<hr>";

/*
Array
(
    [0] => 8000
    [1] => 7000
    [2] => 9000
    [3] => 11000
    )
*/

#example on in_array():
$people = ["peter", "joe", "omar", 23];

var_dump(in_array("23", $people));  // true 
echo"<br>";
var_dump(in_array("23", $people, true));  // false as 23 !== "23"
echo"<hr>";


#example on array_search():
$names = ["ahmed", "mai", "zaki"];

echo array_search("mai",$names), "<br>"; // 1
var_dump(array_search("mido", $names)); //bool(false)
echo"<br>";

$loc = array_search("ahmed", $names); // 0
if($loc !== false){
    echo "found<br>";
}else{
    echo "not found <br>";
}
echo"<hr>";

#example on array_slice():
$names = ["ahmed", "mai", "zaki", "omar", "younes"];

echo"<pre>";
$arr = array_slice($names, 2);
print_r($arr);
echo"</pre>";
/*
Array
(
    [0] => zaki
    [1] => omar
    [2] => younes
)
*/
echo"<pre>";
$arr = array_slice($names ,1,2);
print_r($arr);
echo"</pre>";
/*
Array
(
    [0] => mai
    [1] => zaki
)
*/
echo"<pre>";
$arr = array_slice($names ,-2,1);
print_r($arr);
echo"</pre>";
/*
Array
(
    [0] => omar
)
*/


#example on array_slice():
$a = [
'a'=>"red",
'b'=>"green",
'c'=>'blue'
];
echo"<pre>";
$arr = array_slice($a ,1,2);
print_r($arr);
echo"</pre>";
echo"<hr>";
/*
Array
(
    [b] => green
    [c] => blue
)
*/

#example on array_intersect():
$a1 = [
    'a'=>"red",
    'b'=>"green",
    'c'=>'blue'
];

$a2 = [
    'e'=>"red",
    'f'=>"green",
];

$result = array_intersect($a1, $a2);
echo"<pre>";
print_r($result);
echo"</pre>";
/*
Array
(
    [a] => red
    [b] => green
    )
*/
$arr1 = [1,4,5,6,3];
$arr2 = [6,3,4,7];
$result = array_intersect($arr1, $arr2);
echo"<pre>";
print_r($result);
echo"</pre>";
echo"<hr>";

/*
Array
(
    [1] => 4
    [3] => 6
    [4] => 3
)
*/
#example on array_key_exists():
$cars = [
    'a' => "volvo",
    'b' => "BMW"
];
echo array_key_exists("a", $cars), "<br>"; //1
var_dump(array_key_exists("c", $cars)); //false

echo"<hr>";

#example on sort():
$cars = ["Volvo", "BMW", "Toyota"];
sort($cars);
echo"<pre>";
print_r($cars);
echo"</pre>";
/*
Array
(
    [0] => BMW
    [1] => Toyota
    [2] => Volvo
)
*/

#example on rsort():
$cars = ["Volvo", "BMW", "Toyota"];
rsort($cars);
echo"<pre>";
print_r($cars);
echo"</pre>";
echo"<hr>"; 
/*
Array
(
    [0] => Volvo
    [1] => Toyota
    [2] => BMW
)
*/

#example on asort()
$age = [
    "joe" => 43,
    'mai'=>35,
    'zaki'=>37
];
asort($age);
echo"<pre>";
print_r($age);
echo"</pre>";

/* 
Array
(
    [mai] => 35
    [zaki] => 37
    [joe] => 43
)
*/

#example on arsort()
$age = [
    'mai'=>35,
    'zaki'=>37,
    "joe" => 43
];

arsort($age);
echo"<pre>";
print_r($age);
echo"</pre>";
/*
Array
(
    [joe] => 43
    [zaki] => 37
    [mai] => 35
)
*/

echo"<hr>"; 

#example on ksort()
$age = [
    'mai'=>35,
    'zaki'=>37,
    "joe" => 43
];

ksort($age);
echo"<pre>";
print_r($age);
echo"</pre>";

/*
Array
(
    [joe] => 43
    [mai] => 35
    [zaki] => 37
)
*/

#example on krsort()
$age = [
    'mai'=>35,
    'zaki'=>37,
    "joe" => 43
];

krsort($age);
echo"<pre>";
print_r($age);
echo"</pre>";
echo"<hr>";
/*
Array
(
    [zaki] => 37
    [mai] => 35
    [joe] => 43
)
*/

$degrees = [32,11,23, 16, 5, 2, 50];

shuffle($degrees);
echo"<pre>";
print_r($degrees);
echo"</pre>";
echo"<hr>";
/*
Array
(
    [0] => 16
    [1] => 23
    [2] => 11
    [3] => 5
    [4] => 2
    [5] => 32
    [6] => 50
)

*/
#example on array_unique():
$degrees = [10, 2, 5, 6, 2,10];
$arr = array_unique($degrees);
echo"<pre>";
print_r($arr);
echo"</pre>";
echo"<hr>";
/*
Array
(
    [0] => 10
    [1] => 2
    [2] => 5
    [3] => 6
)
*/

#example on array_splice():
$cars = ["Volvo", "BMW", "Toyota", "Honda", "pegoute", "jeep"];

$result = array_splice($cars,2, 3);
echo"<pre>";
print_r($cars);
echo"</pre>";
/*
Array
(
    [0] => Volvo
    [1] => BMW
    [2] => jeep
)
*/
echo"<pre>";
print_r($result);
echo"</pre>";
echo"<hr>";
/*
Array
(
    [0] => Toyota
    [1] => Honda
    [2] => pegoute
)
*/

#example on array_splice():
$cars = ["Volvo", "BMW", "Toyota", "Honda", "pegoute", "jeep"];

$result = array_splice($cars,1, 2, ["mercedes", "byd", "shahin"]);

echo"<pre>";
print_r($cars);
echo"</pre>";
/*
Array
(
    [0] => Volvo
    [1] => mercedes
    [2] => byd
    [3] => shahin
    [4] => Honda
    [5] => pegoute
    [6] => jeep
)
*/
echo"<pre>";
print_r($result);
echo"</pre>";
echo"<hr>";

/*
Array
(
    [0] => BMW
    [1] => Toyota
)
*/