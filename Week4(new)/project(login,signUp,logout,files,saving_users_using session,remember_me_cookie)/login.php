<?php
session_start();

require_once("usersArray.php");
//list of users
// $users = [
//     "ahmed@gmail.com" =>["pw"=>"123", "name"=>"ahmed"],
//     "doaa@gmail.com" =>["pw"=>"abcdf", "name"=>"doaa"],
//     "sara@gmail.com" =>["pw"=>"159", "name"=>"sara"],

// ];

// echo "<pre>";
// print_r($users);
// echo "</pre>";


//check name and password 
if(!empty($_POST["email"]) && !empty($_POST["pw"])){

    //validate input
    $email = filter_var(strip_tags($_POST["email"]),FILTER_SANITIZE_EMAIL);//strip_tags to remove tags, sanitize email to remove spaces and special characters

    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $pw = $_POST["pw"];

        //check if email exists in array(list of emails) , and if pw sent from user == password in email
        if(isset($users[$email]) && $users[$email]["pw"] == $pw){
            if(!empty($_POST["remember"]) && $_POST["remember"] == 1){

                $user_data = ["email"=>$email,"name"=>$users[$email]["name"]];

                setcookie("user", json_encode($user_data), time()+ 60*60*24);
            }

            //if valid_login ,save user in session ,then go to home.php
            $_SESSION["user_data"] = ["email"=>$email,"name"=>$users[$email]["name"]]; 


            header("location:home.php");
        }else{
            header("location:index.php?error=incorrect_email_or_password");
        }
    }else{
        header("location:index.php?error=invalid_email_format");
    }

}else{
    header("location:index.php?error=empty_email_or_password");
}