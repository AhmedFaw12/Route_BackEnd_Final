<?php
/*
    1)ceil(float value)

    2)floor(float value)

    3)round(float value)

    4)abs(value)

    5)pow(number, power)

    6)rand(int min(optional), int max(optional)):int
    -Generate a random integer
    -return int
    A pseudo random value between min (or 0) and max (or getrandmax, inclusive).

    7)min(mixed $value, mixed ...$values):Find lowest value
    -parameters:

    -array|mixed $value — Array to look through or first value to compare
    -any comparable value

    8)max() : find highest value

    9)octdec(string octal):float|int
        -convert Octal to decimal

    10)decoct(int number):string :
        - Decimal to octal

    11)bindec(string bin):float|int
        -Binary to decimal

    12)decbin(int number):string:
        Decimal to binary
    
    13)dechex(int $num): string
        Decimal to hexadecimal
    14)hexdec(string $hex_string): int|float
        Hexadecimal to decimal

    15) base_convert(string $num, int $from_base, int $to_base): string  :
    Convert a number between arbitrary bases

    -notes:
    binary -> 2
    hexa -> 16
    decimal ->10
    octal ->8
*/

#example on rand()
echo rand(), "<br>"; //any random number 
echo rand(10, 20) ,"<br>";

#example on min()
echo min(2,1,0, -1) , '<br>';//-1
echo min([2,3,5,10,0]), "<br>"; // 0

$min_array = min([2,5,0,-2], [2,6,-3,-6]);//return min array by comparing 1st element in first array with 1st  element in second array , ................
echo "<pre>";
print_r($min_array);// [2,5,0,-2]
echo "</pre>";


#examples on conversions:
echo octdec("36"), "<br>"; //30
//6 * (8^0) + 3*(8^1) = 30

echo decoct(30), "<br>"; //36

echo hexdec("1e"),"<br>"; //30

#example on base_convert(): convert from hex to dec
$hex = "e196";
echo base_convert($hex, 16, 10), "<br>";//57750