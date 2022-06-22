<pre>
<?php

require_once("User.php");

// $u = new User(); //Cannot instantiate abstract class User

require_once("Rect.php");

//create instance
//memory is divided into stack and heap 
//$r1 is stored in stack
//object is stored in heap
//$r1 reference object
//php initialize variable with null
$r1 = new Rect(10,5);
// $r1->length = 10;
// $r1->width = 5;
echo $r1->get_length();
echo "<hr>";

//another object
$r2 = new Rect(20,15);
// $r2->length = 20;
// $r2->width = 15;

//making copy to the address of the object(pass by reference)
$r3 = $r1;
// echo $r3->length;//10
// echo "<hr>";

//Example pass by value(copy the value)
$x1 = 10;
$x2 = $x1 ; // x2 = x1 = 10
$x1 = 20; // x1 = 20 , x2 = 10


//printing area of r1, r2
echo $r1->area();//10*5 = 50
echo "<hr>";
echo $r2->area();//15*20 = 300

//creating square not rectangle
$s1 = new Rect(15);
echo "<hr>";
echo $s1->area();//15*15 = 225
echo "<hr>";
//////////////////////////////////////////
//Inheritance
//we will only require employee because employee already requires user
require_once("Employee.php");
require_once("Customer.php");

// $e = new Employee();
// echo "<pre>";
// var_dump($e);
// echo "</pre>";
// echo "<hr>";

// echo $e->profile();
// echo "<hr>";

$c = new Customer();
var_dump($c);
echo "<hr>";
$c = new Circle(80);
Info::print($c);
echo "<hr>";

////////////////////////////////////////////////////////////////
$box = new Box(4,5,6);
var_dump($box);
echo "<hr>";
echo $box->area();
echo "<hr>";
Info::print($box);
echo "<hr>";

/////////////////////////////////////////////////////////
$ss = new Sales();
$ss->salary = 2500;
$ss->collection = 150000;
$ss->ratio = 0.01;
$ss->target = 100000;

echo $ss->net_salary();
echo "<hr>";

$i = new Instructor();
$i->salary = 2500;
$i->hour_price = 100;
$i->hours = 40;

echo $i->net_salary();
// var_dump($ss);
echo "<hr>";

//////////////////////////////////////////////////////////
echo Info::PI;
Info::$counter = 1;
echo "<br>";
echo Info::$counter;
echo "<br>";
Info::$counter++;
echo Info::$counter;
echo "<br>";

?>
</pre>

