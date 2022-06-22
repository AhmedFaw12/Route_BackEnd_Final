<?php

/*
  loops in php :
  
  1) while
  2) for
  3) do while: is executed at least once
  4) foreach ( with arrays or collections)

  -break: To break the loop that you are currently inside
  -continue : skip one loop

  -note on spaces in HTML:
    -Ahmed        Fawzy : will be read Ahmed Fawzy with 1 space only
    -inorder to write multiple spaces use (pre tag):
    <pre>
    Ahmed         Fawzy
    </pre>

    -pre tag : will paste everything i write as it is

    -another way is to use &nbsp : evey &nbsp represent 1 space
    Ahmed&nbsp&nbsp&nbsp&nbspFawzy

    - note on conditions: 
     0 or null or false or empty string will give false
*/

#example on while loop
$counter = 1;
while($counter <= 10){
    echo $counter++ , '<br>';
}

#example 
$x = 10;
while($x){
    echo "Hello $x <br>";
    $x--;// 0 or null or false or empty string will give false
    // $x = null;
}

#example on while loop (sum of nums from 1 to 1000)
$i = 1;
$sum = 0;
while($i <= 1000){
    $sum += $i++;
}
echo $sum , "<br>";
echo "<hr>";

//////////////////////////////////////////////////////////
#example on do while
$i = 1;
do{
   echo $i++ , "<br>";
}while($i <= 10);

echo "<hr>";

///////////////////////////////////////////////////////////
#example on for loop
for($i = 10; $i >= 1; $i--){
    echo $i, "<br>";
}

#example on for (sum from 1 to 1000)
$sum = 0;
for($i = 1; $i <= 1000; $i++){
    $sum += $i;
}
echo $sum , "<br>";

#example on nested for (print multiplication table)
for($i = 1; $i <= 10; $i++){
    for($j = 1; $j <= 10; $j++){
        echo "$i X $j = ", ($i * $j), "<br>";
    }
    echo "<hr>";
}
echo "<hr>";

#example on nested for
/*
    print triangle
    **********
    *********
    ********
    *******
    ******
    *****
    ****
    ***
    **
    *
*/
$n = 10;
for($i = $n; $i >= 1; $i--){
    for($j = 1; $j <= $i; $j++){
        echo "*";
    }
    echo "<br>";
}

echo "<hr>";
#example 
/*
print triangle
*
**
***
****
*****
******
*******
********
*********
**********
*/
$n = 10;
for($i = 1; $i <= $n; $i++){
    for($j = 1; $j <= $i; $j++){
        echo "*";
    }
    echo "<br>";
}
echo "<hr>";
#example on nested for 
/*
print pyramids
***********
-*********
--*******
---*****
----***
-----*
*/

for($i = 6; $i >= 1; $i--){
 
    for($spaces = 1; $spaces <= 6-$i; $spaces++){
        echo "&nbsp&nbsp";
    }
    for($j = 1; $j < $i*2 ; $j++){
        echo "*";
    }
    echo "<br>";
}
echo "<hr>";   

#example on nested for loop
/* 
-----*
----***
---*****
--*******
-*********
***********
*/

for($i = 1; $i <= 6; $i++){
 
    for($spaces = 1; $spaces<= 6-$i; $spaces++){
        echo "&nbsp&nbsp";
    }
    for($j = 1; $j < $i*2 ; $j++){
        echo "*";
    }
    echo "<br>";
}


#example on continue(print even number)
for($i = 1; $i <= 10; $i++){
    if($i % 2 == 1){
        continue;
    }
    echo "$i <br>";
}

//another solution
$i = 1;
while($i <= 10){
    if($i % 2 == 1){
        $i++;
        continue;
    }
    echo $i++, "<br>";
}

echo "<hr>";
