<?php
//practice 1:

echo"practice 1: <br>";
echo"Hello <br>";
echo"Ahmed Fawzy <br>";
echo"<hr>";

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//practice 2:
echo"practice 2: <br>";

//a)
echo "a.-5 + 8 * 6", (-5 + 8 * 6),"<br>";
//b
echo "b.(55+9) % 9 ", ((55+9) % 9 ),"<br>";
echo "c. 20 + -3*5 / 8  ",(20 + -3*5 / 8) ,"<br>";
echo "d. 5+15 / 3*2 - 8 % 3",(5 + 15 / 3 * 2 - 8 % 3 ),"<br>";
echo"<hr>";
/////////////////////////////////////////////////////////////
//practice 3:
echo"practice 3: <br>";
echo "((25.5 * 3.5 - 3.5 * 3.5) / (40.5 - 4.5)) ",((25.5 * 3.5 - 3.5 * 3.5) / (40.5 - 4.5)) ,"<br>";
echo"<hr>";
/////////////////////////////////////////////////////////////
//practice 10:
echo"practice 10: <br>";
$cnt = 0;

for($i = 1; $i <= 4; $i++){
    for($j = 1; $j <= 4; $j++){
        for($k = 1; $k <= 4; $k++){
            if($i != $j && $i != $k && $j != $k){
                $cnt++;
                echo "$i$j$k<br>";
            }
        }        
    }
}
echo"Total number of the three-digit-number is $cnt<br>";
echo"<hr>";