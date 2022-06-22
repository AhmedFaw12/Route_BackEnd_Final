<?php

/*          arrays:

    -arrays in php , js are variable size not fixed size
    
    -array are random access : we can reach specific element direct using key or index without the need to pass through the elements that comes before our element
    
    -arrays are good performance

    -array in php has 2 types:
    1)numeric arrays:called numeric because we can reach elements using index.

    2)associative arrays:each element consists of key and value , we can reach the element using key
    - => is called fat arrow


    -Two ways to  define array:
    1) using array function :
        $names = array("ali","sara" ,"ahmed");
    
    2) using []:
        $degrees = [50,40,60];
    

    -count($arr_name) : will get the length(num of elements) of array


    -foreach: to loop over arrays
        -writing 1 variable will get value
        -writing 2 variables will get key , value
    

    -print_r(): we can not echo an array , but we can use print_r($arr_name) to print array
    
    -difference between print_r() and var_dump() is that print_r() print the array without printing datatypes of its elements. and also print_r is more readable than var_dump()


    -adding elemet to the end of array:
    example :
    $names = [];
    $names[] = "ahmed";

	-array by default are passed by reference(pass its address) , array is stored in heap
*/

#example on defining arrays
$names = array("ali","sara" ,"ahmed");
$degrees = [50,40,60];

var_dump($names);
echo "<hr>";

//print array using foreach
foreach($names as $i => $name) echo "$i = $name <br>";

echo "<hr>";
//print array using foreach without index
foreach($degrees as $deg) echo "$deg<br>";

echo "<hr>";
//print array
for($i = 0; $i<count($names); $i++){
    echo $names[$i], " ", $degrees[$i], "<br>";   
}


//////////////////////////////////////////////////////////////
#example on associative array
$students = ["ali"=> 90, "dina"=> 80,"sara"=>70,"ahmed"=> 100];

echo $students["ali"];
echo "<hr>";

//example on foreach
foreach($students as $name => $deg){
    echo "$name = $deg <br>";
}

#example on foreach(printing without key)
foreach($students as $d){
    echo "$d <br>";
}

echo "<hr>";

#example get the sum of array
$sales = [1800, 1900, 25000];
$sum = 0;
foreach($sales as $sale){
    $sum += $sale;
}
echo "$sum <br>";
echo "<hr>";


#example on nested arrays
$students = [
    "ahmed" => [15,19,20],
    "ali" => [25,29,18],
    "mona" => [19,17,20]
];

#example on printing array using print_r
print_r($students["ahmed"]);
// var_dump($students["ahmed"]);
echo "<br>";

//access nested arrays
echo $students["ali"][2];  //18
echo "<hr>";
//printing nested arrays
foreach($students as $name => $degrees){
    
    echo $name;
    foreach($degrees as $deg){
        echo " $deg ";
    }
    echo "<br>";
}
echo "<hr>";



#example on nested arrays
#array don't need to have same size as other arrays
$students = [
    "ahmed" => [15,19,20],
    "ali" => [25,29],
    "mona" => [19,17,20]
];

#example on adding element to array
$names = ["ahmed", "mai"];
$names[] = "omar";

$names["ali"] = 333;
print_r($names);//Array ( [0] => ahmed [1] => mai [2] => omar [ali] => 333 )
echo "<hr>";

#example on adding element to associative array
$data = [
    "name" => "mai",
    "age" => 26,
    "job" => "php developer"
];
    
$data["faculty"] = 'eng';

#example on remove element from numeric array using unset
$names = ["ahmed", "mai", "omar", "hamdy"];
unset($names[2]);
print_r($names);//Array ( [0] => ahmed [1] => mai [3] => hamdy )
echo "<hr>";

#example on remove element from associative array using unset
$data = [
"name" => "mai",
"age" => 26,
"job" => "php developer"
];

$data["faculty"] = 'eng';
unset($data['age']);
print_r($data);//Array ( [name] => mai [job] => php developer [faculty] => eng )