<?php
//filter validation

//created errors array
session_start();
//check if user role is not empty and is admin 
if (!empty($_SESSION["user"]) && $_SESSION["user"]["role"] == "admin") {
    $user = $_SESSION["user"];

    $errors = [];

    $old_values = ["name" => null, "email" => null, "mobile" => null]; // so that in register.php , we will not check if(empty($_SESSION["old_values"])) and only check if(empty($_SESSION["old_values"]["name or email or mobile"]))

    //check that every input is not empty and that pass == pass_confirmation
    if (empty($_REQUEST["name"])) {
        $errors["name"] = "Name is Required";
    } else {
        $old_values["name"] = $_REQUEST["name"];
    }

    if (empty($_REQUEST["email"])) {
        $errors["email"] = "Email is Required";
    } else {
        $old_values["email"] = $_REQUEST["email"];
    }

    if (empty($_REQUEST["mobile"])) {
        $errors["mobile"] = "Mobile is Required";
    } else {
        $old_values["mobile"] = $_REQUEST["mobile"];
    }

    if (empty($_REQUEST["pass"])) {
        $errors["pass"] = "Password is Required";
    } else if (empty($_REQUEST["pass_confirmation"])) {
        $errors["pass_confirmation"] = "Confirm Password is Required";
    } else if ($_REQUEST["pass"] != $_REQUEST["pass_confirmation"]) {
        $errors["pass_confirmation"] = "Password and Confirm Password not matched";
    }



    $name = strip_tags(trim($_POST["name"])); //strip_tags to remove tags, trim to remove spaces at begin and end

    $email = filter_var(strip_tags($_POST["email"]), FILTER_SANITIZE_EMAIL); //sanitize email to remove spaces ,strip_tags to remove tags

    $mobile = filter_var(strip_tags(trim($_POST["mobile"])), FILTER_SANITIZE_NUMBER_INT); //sanitize_number_int to remove anything except numbers

    $pw = htmlspecialchars($_POST["pass"]);

    // $pwc = htmlspecialchars($_POST["pass_confirmation"]); // don't the variable since we checked that pass and pass_confirmation are identical

    $gender = $_POST["gender"];
    $role = $_POST["role"]; //added $role variable
  
    //check if email is not valid
    if (empty($errors["email"]) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Email Invalid Format please Enter : XX@yyy.com";
    }

    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
    
    // check if email already exists
    $qry = "select email from users where email = '$email'";
    $rslt = mysqli_query($cn, $qry);
    if($row = mysqli_fetch_assoc($rslt)){//email already exists
        $errors["email"] = "email already exists";
    }

    //saving data in database if errors array is empty
    if (empty($errors)) {

        $pw = md5($pw); //encrypting password

        // check if email already exists
        $qry = "select email from users where email = '$email'";
        $rslt = mysqli_query($cn, $qry);
        if($row = mysqli_fetch_assoc($rslt)){//email already exists
            $errors["email"] = "email already exists";
            $_SESSION["errors"] = $errors;
            header("location:users_create.php");
        }

        $qry = "insert into users(email, mobile, name, password, gender, role, created_by) values('$email', '$mobile', '$name', '$pw', '$gender', '$role', ".$user['id'].")";

        $rslt = mysqli_query($cn, $qry);

        // echo mysqli_error($cn);
        // var_dump($rslt);
        mysqli_close($cn);
        if ($rslt) {
            header("location:users_create.php");
        }
    } else {
        $_SESSION["errors"] = $errors;
        $_SESSION["old_values"] = $old_values;

        header("location:users_create.php");
    }
} else {
    header("location:home.php");
}
