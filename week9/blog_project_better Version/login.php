<?php 
session_start();
require_once("config.php");
//filter & validate
// validate inputs
$errors = [];
$old_values = ["email"=>null];

if(empty($_REQUEST["email"])){
    $errors["email"] = "Email is required";
}else{
    $old_values["email"] = $_REQUEST["email"];
}
if(empty($_REQUEST["pass"])){
    $errors["password"] = "Password is required";
}

$password = md5(htmlspecialchars($_REQUEST["pass"]));
$email = filter_var(strip_tags( $_REQUEST["email"]), FILTER_SANITIZE_EMAIL);

if(empty($errors["email"]) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors["email"] = "Invalid Email Format please Enter : XX@yyy.com";
}

if(empty($errors)){
    $cn  = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, PORT);

    $qry = "select id, email, mobile, name,gender, role, avtar, created_at from users where email = '$email' and password='$password' and active=1 ";

    $rslt = mysqli_query($cn, $qry);
    if($row = mysqli_fetch_assoc($rslt)){
        $_SESSION["user"] = $row;
        header("location:home.php");
    }else{
        $errors["Invalid_login"] = "Invalid Email Or Password";
        $_SESSION["errors"] = $errors;
        header("location:index.php");
        // echo mysqli_error($cn);
    }

    mysqli_close($cn);
}else{
    $_SESSION["errors"] = $errors;
    $_SESSION["old_values"] = $old_values;

    header("location:index.php");
    
}

