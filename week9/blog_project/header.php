<?php
session_start();
//check lang
$lang = "en";
if(!empty($_SESSION["lang"])){
    $lang = $_SESSION["lang"];
}

if($lang == "ar") require_once("messages_ar.php");
else require_once("messages_en.php");


//check if session is empty incase someone wrote home page in the url without login
if (empty($_SESSION["user"])) {
    header("location:index.php?error=secure_page");
} else {
    $user = $_SESSION["user"];
    //check if we are in users_create.php (active_link=="users"), also check if role != admin
    if($active_link== "users" && $user["role"] != "admin"){
        session_destroy();
        header("location:index.php?error=secure_page");
    }
}
?>
<!DOCTYPE html>
<html lang="<?=$lang?>" dir ="<?=$messages["dir"]?>">

<head>
    <title>Login V1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>

<body style="  background: linear-gradient(-135deg, #c850c0, #4158d0);
">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand mx-3" href="home.php">BLOG</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav <?=$messages["mr"]?>-auto">
                <li class="nav-item
                <?php
                //solution 1 of making active attribute dynamic
                // if(strpos($_SERVER["REQUEST_URI"], "home.php")){
                //     echo "active";
                // } 

                //solution 2 of making active attribute dynamic
                if ($active_link == "home") echo "active";
                ?>
                ">
                <a class="nav-link" href="home.php">Home</a>
                </li>
                
                <!-- link for users -->
                
                <!-- dropdown menu appears only to admin -->
                <?php if($user['role'] == "admin") {?>
                <li class="nav-item dropdown 
                <?php
                //solution 1 of making active attribute dynamic
                // if(strpos($_SERVER["REQUEST_URI"], "users_create.php")){
                //     echo "active";
                // } 

                //solution 2 of making active attribute dynamic
                if ($active_link == "users") echo "active";
                ?>
                ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Users
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="users_create.php">Add Users</a>
                        <a class="dropdown-item" href="users.php">Users List</a>
                       
                    </div>
                </li>
                <?php } ?>


            </ul>


            
            <ul class="navbar-nav<?=$messages["ml"]?>-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?=$user["name"]?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        
                            <?php 
                                if($lang == "ar"){
                            ?>
                                <a class="dropdown-item" href="change_lang.php?lang=en">ُEnglish</a>                            
                            <?php
                                }else{
                            ?>
                                <a class="dropdown-item" href="change_lang.php?lang=ar">اللغة العربية</a>  
                            <?php
                                
                                }
                            ?>
                        
                        <a class="dropdown-item" href="logout.php">logout</a>
                       
                    </div>
                </li>
            </ul>

        </div>
    </nav>