<?php
//array sorting example
$arr = array(10, 5, 20, 4, 1, 200);

echo "array before Sort:";
echo"<pre>";
print_r($arr);
echo"</pre>";



//passing by reference
function array_sort_ascending(&$arr)
{
    $temp = null;
    $min = null;
    for ($i = 0; $i < count($arr) - 1; $i++) {
        $min = $i;
        //determine the min in the iteration
        for ($j = $i + 1; $j < count($arr); $j++) {
            if ($arr[$j] < $arr[$min]) {
                $min = $j;
            }
        }
        //swap
        $temp = $arr[$i];
        $arr[$i] = $arr[$min];
        $arr[$min] = $temp;
    }
}

array_sort_ascending($arr);
echo "<hr>";
echo "array After ascending Sort:";
echo"<pre>";
print_r($arr);
echo"</pre>";

function array_sort_descending(&$arr)
{
    $temp = null;
    $min = null;
    for ($i = 0; $i < count($arr) - 1; $i++) {
        $max = $i;
        //determine the min in the iteration
        for ($j = $i + 1; $j < count($arr); $j++) {
            if ($arr[$j] > $arr[$max]) {
                $max = $j;
            }
        }
        //swap
        $temp = $arr[$i];
        $arr[$i] = $arr[$max];
        $arr[$max] = $temp;
    }
}

echo "<hr>";
array_sort_descending($arr);
echo "array After descending Sort:";
echo"<pre>";
print_r($arr);
echo"</pre>";