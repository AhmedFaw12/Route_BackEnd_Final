<?php

//making users array by reading the users file and saving its values in array
$users = [];
$file = fopen("users.csv", "r");

while ($line = fgets($file)) {

    $arr = explode(",", $line);

    if (!isset($users[$arr[0]])) {
        $users[$arr[0]] = ["name" => $arr[1], "password" => trim($arr[2])]; // trim to remove the \n in the file
    }
}

fclose($file);
