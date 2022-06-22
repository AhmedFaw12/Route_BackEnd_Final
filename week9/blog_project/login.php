<?php
session_start();
//validate and filter same as register_action.php
$errors = [];
// $old_values = ["email"=>null];

//check that every input is not empty
if(empty($_REQUEST["email"])){
    $errors["email"] = "Email is Required";
}
// else{
//      $old_values["email"] = $_REQUEST["email"];
// }

if(empty($_REQUEST["pass"])) {
    $errors["pass"] = "Password is Required";
}

//if $_POST["email"]email is empty or not created ,$email will contain empty
$email = filter_var(strip_tags($_POST["email"]), FILTER_SANITIZE_EMAIL);//sanitize email to remove spaces ,strip_tags to remove tags

// echo $_POST["email"], "<hr>";

$pass = md5(htmlspecialchars($_POST["pass"]));//htmlspecialchars to stop tags from working, md5 to encrypt the password


//check if email is not valid
if(empty($errors["email"]) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors["email"] = "Email Invalid Format please Enter : XX@yyy.com";
}

if(empty($errors)){
    //compare data with the data in database
    $qry = "select id, email, mobile, name,gender, role, avtar, created_at from users where email='$email' and password='$pass' and active=1 ";
    
    require_once("config.php");
    
    $cn = mysqli_connect(HOST_NAME,DB_USER_NAME,DB_PW, DB_NAME, DB_PORT);
    
    
    $rslt = mysqli_query($cn, $qry);
    
    //check if we can fetch the data if input data matched with data in database
    if($row = mysqli_fetch_assoc($rslt)){

        //after we succeded to get user data, save user data in session ,then go to home.php
        $_SESSION["user"] = $row;
        header("location:home.php");
        // var_dump($row);
    }else{
    
       $errors["invalid_login"] = "Invalid Email or Password";
       $_SESSION["errors"] = $errors;
    //    $_SESSION["old_values"] = $old_values;
       header("location:index.php?email=$email");
    }
    mysqli_close($cn);

}else{
    $_SESSION["errors"] = $errors;
    // $_SESSION["old_values"] = $old_values;
    header("location:index.php?email=$email");
}
