<?php
session_start();
require_once("config.php");

// validate inputs
$errors = [];
$old_values = ["name"=>null, "email"=>null, "mobile"=>null];
//email, name, mobile, gender, pass, confirm_pass
if(empty($_REQUEST["name"])){
    $errors["name"] = "name is required";
}else{
    $old_values["name"] = $_REQUEST["name"];
}
if(empty($_REQUEST["email"])){
    $errors["email"] = "Email is required";
}else{
    $old_values["email"] = $_REQUEST["email"];
}

if(empty($_REQUEST["mobile"])){
    $errors["mobile"] = "Mobile is required";
}else{
    $old_values["mobile"] = $_REQUEST["mobile"];
}
if(empty($_REQUEST["pass"])){
    $errors["password"] = "Password is required";
}

if(empty($_REQUEST["confirm_pass"])){
    $errors["confirm_password"] = "Confirm Password is required";
}
else if($_REQUEST["pass"] != $_REQUEST["confirm_pass"]){
    $errors["confirm_password"] = "Password and Confirm Password are not matched";
}

if(empty($_REQUEST["gender"])){
    $errors["gender"] = "Gender is Required";

}


$name = strip_tags(trim($_REQUEST["name"]));
$email = filter_var(strip_tags($_REQUEST["email"]), FILTER_SANITIZE_EMAIL) ;
$mobile = filter_var(strip_tags($_REQUEST["mobile"]), FILTER_SANITIZE_NUMBER_INT);
$password = htmlspecialchars($_REQUEST["pass"]);

$gender = $_REQUEST["gender"];

if(empty($errors["email"]) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors["email"] = "Email Invalid Format please Enter : XX@yyy.com";
}

//check if email already exists
$cn  = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, PORT);

$qry = "select email from users where email = '$email'";
$rslt = mysqli_query($cn, $qry);
if($row = mysqli_fetch_assoc($rslt)){
    if(empty($errors["email"])){
        $errors["email"] = "Email Already Exists";
    }
}
mysqli_close($cn);

//saving data in database if errors array is empty
if(empty($errors)){
    $password = md5($password);

    $qry = "insert into users(email, name, mobile, password, gender) values('$email', '$name', '$mobile', '$password', '$gender')";
    
    $cn  = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, PORT);
    $rslt = mysqli_query($cn, $qry);
    if($rslt){
        header("location:index.php");
    }else{
        var_dump(mysqli_error($cn));
    }
    mysqli_close($cn);
}else{
    $_SESSION["errors"] = $errors;
    $_SESSION["old_values"] = $old_values;
    // var_dump($errors);
    header("location:register.php");
}