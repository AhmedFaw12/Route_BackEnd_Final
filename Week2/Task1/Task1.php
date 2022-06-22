<?php

/***************** question 1 *****************/
$hexMessage = '596f7520636f6e76657274656420697420636f72726563746c7921';

$message = hex2bin($hexMessage);

echo $message ."<br>" ."<br>";

echo "<hr>";


/***************** question 2 *****************/
$htmlContent = "<h1>PHP track</h1><p>PHP is an interpreted language</p>";

echo strip_tags($htmlContent) ."<br>" ."<br>";

echo "<hr>";

/***************** question 3 *****************/
$username = " Kareem Fouad ";

$username = trim($username);

var_dump($username) ;
echo "<br> <br>";
echo "<hr>"; 


/***************** question 4 *****************/
$num = 15023198.91;

var_dump(number_format($num,2));
echo "<br> <br>";
echo "<hr>"; 



/***************** question 5 *****************/
$employeePositions = [
  'kareem fouad' => 'backend',
  'ahmed bahnasy' => 'frontend',
  'mohammed nabeel' => 'android',
  ];

$keys = array_keys($employeePositions);
$values = array_values($employeePositions);
echo "<pre>";
print_r($keys);
print_r($values);
echo "</pre>";

echo "<br> <br>";
echo "<hr>"; 

/***************** question 6 *****************/
$nums = [4, 7, 1];

//list($x, $y, $z) = $nums;

[$x, $y, $z] = $nums;

echo "$x $y $z";

echo "<br> <br>";
echo "<hr>"; 


/***************** question 7 *****************/
$userData = [
  'name' => 'kareem',
  'job' => 'backend',
  'language' => 'php',
  'framework' => 'laravel',
];

extract($userData);

echo "$name $job $language $framework" ;

echo "<br> <br>";
echo "<hr>"; 
