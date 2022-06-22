<?php

$d = date("d");
$m = date("m");

echo $d . " " . $m;

switch ($m) {
    case 3:
        echo ($d >= 20) ? "spring" : "winter";
        break;

    case 6:
        echo ($d >= 21) ? "summer" : "spring";
        break;
    case 9:
        echo ($d >= 22) ? "autumn" : "summer";
        break;
    case 12:
        echo ($d >= 21) ? "winter" : "autumn";
        break;
        
    case 4:
    case 5:
        echo "spring";
        break;
    case 7:
    case 8:
        echo "summer";
        break;
    case 10:
    case 11:
        echo "autumn";
        break;
    case 1:
    case 2:
        echo "winter";
        break;
    default:
        echo "invalid input";    
}
