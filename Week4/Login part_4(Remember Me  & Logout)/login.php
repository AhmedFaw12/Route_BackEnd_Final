<?php
session_start();

$users = [
    "ahmed@gmail.com" => array("name" => "ahmed", "password" => "123"),
    "ali@gmail.com" => array("name" => "ali", "password" => "456"),
    "mai@gmail.com" => array("name" => "mai", "password" => "789"),
];


//Validation 
//1-check that post is not empty
if (!empty($_POST["email"]) && !empty($_POST["password"])) {

    //2-sanitize and validate email
    $email = filter_var(filter_var($_POST["email"], FILTER_SANITIZE_STRING), FILTER_SANITIZE_EMAIL);
    
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        
        $password = $_POST["password"];
        
        //check that email and password is in our database or array
        if (!empty($users[$email])  && $users[$email]["password"] === $password) {
            
            //save user in session and go to home page
            $_SESSION["user"] = ["name"=>$users[$email]["name"] , "email"=> $email ];

            //if email and password correct , then check if remeberMe checkbox is marked , then set the cookie with user data 
            if(!empty($_POST["rememberMe"]) && $_POST["rememberMe"] == 1){
                
                setcookie("rememberMeData", json_encode($_SESSION["user"]) , time() + 60*60*24*2);
            }
            
            header("location:home.php");

            //echo "Welcome " .  $users[$email]['name'];
        } else {
            header("location:index.php?error=Invalid Email or Password");
        }
    }else{
        header("location:index.php?error=Invalid_email_format");    
    }

}else{
    header("location:index.php?error=empty");
}
