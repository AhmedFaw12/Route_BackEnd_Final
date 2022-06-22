<?php
session_start();
//filter and validate POST
if(!empty($_POST["email"]) && !empty($_POST["name"]) && !empty($_POST["password"])){
    
    $email = filter_var(strip_tags($_POST["email"]), FILTER_SANITIZE_EMAIL);
    
    $name = strip_tags($_POST["name"]);
    
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $pw = $_POST["password"];

        //checking if email already exists in the file or not
        $isEmailExists = false;
        $file = fopen("users.csv", "r");
        while($line = fgets($file)){
            $arr = explode(",", $line);
            if($arr[0] === $email){
                $isEmailExists = true;
                break;
            }
        }
        fclose($file);

        //adding new user to a file instead of the static array that we were reading from it 
        // if email not exists in the file , then add the user to the file
        if(!$isEmailExists){
            $f = fopen("users.csv", "a");

            fwrite($f, "$email,$name,$pw\n");
        
            $_SESSION["user_data"] = ["email"=>$email,"name"=>$name];      
            fclose($f);
            
            header("location:home.php");
        }else{
            header("location:signUp.php?error=email_already_exists");
        }
    }else{
        header("location:signUp.php?error=invalid_email_format");
    }
}else{
    header("location:signUp.php?error=empty_email_or_password_or_name");
}



