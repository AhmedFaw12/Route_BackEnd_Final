<?php
session_start();

//filter and validate email, name , pw

if (!empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['password'])) {

    //removing illegal chars and html tags from name , email
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);


    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $pw = $_POST['password'];

        //saving user in session
        $_SESSION["user"] = ["name"=>$email , "email"=> $email ];

        //checking if the email already exists in the file or not 
        $email_exists_flag = false;
        $file = fopen("users.csv", 'r');
        while($line = fgets($file)){
            $arr = explode(",", $line);
            if($arr[0] === $email ){
                $email_exists_flag = true;
                break;
            }
        }
        fclose($file);

        //adding new user to a file instead of the static array that we were reading from it 
        // if email not exists in the file , then add the user to the file
        if(!$email_exists_flag){
            $file = fopen("users.csv", 'a');
            fwrite($file, "$email,$name,$pw\n");
            fclose($file);

            header("location:home.php");
            //echo "Email added successfully <br>";
        }else{
            header("location:signUp.php?error=email_already_exists");
        }
    }else{
        header("location:signUp.php?error=Invalid_email_format");
    }
}else{
    header("location:signUp.php?error=empty");
}
