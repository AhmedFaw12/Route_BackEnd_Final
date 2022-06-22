<?php

session_start();
$name = $_SESSION["user"]["name"];
session_unset();
$_SESSION["success"] = ["Good_Bye_msg" =>"GoodBye $name"];
header("location:index.php");