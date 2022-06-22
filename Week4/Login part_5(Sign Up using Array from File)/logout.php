<?php
session_start();

//if i want to logout , then delete user data from the session
// also delete user data from cookies
session_destroy();

setcookie("rememberMeData", null , time()); // setting cookies data to null , and time() to delete it now

header("location:index.php");

