<?php
//making users array by reading the users file and saving its values in array

$users = [];
$file = fopen("users.csv", "r");
while($line = fgets($file)){
    $user = explode(",", $line);
    //user[0] ---> email of user
    if(!empty($user[1]) && !empty($user[2])){

        $users[$user[0]] = ["name"=>$user[1], "pw"=>$user[2]];
    }
}

fclose($file);