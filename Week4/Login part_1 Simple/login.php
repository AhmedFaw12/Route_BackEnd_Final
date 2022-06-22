<?php

$users = [
    "ahmed@gmail.com" => array("name" => "ahmed", "password" =>"123"),
    "ali@gmail.com" => array("name" => "ali", "password" =>"456"),
    "mai@gmail.com" => array("name" => "mai", "password" =>"789"),
];


$email = $_POST["email"];
$password = $_POST["password"];

if(!empty($users[$email])  && $users[$email]["password"] === $password ){
    // header("location:home.html");
    echo "Welcome " .  $users[$email]['name'];
}
else{
    header("location:index.php?error=Invalid Email or Password");
}