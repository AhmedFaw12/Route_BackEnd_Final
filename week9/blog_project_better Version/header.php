<?php
	session_start();
	$lang = "en";
	if(!empty($_SESSION["lang"])){
		$lang = $_SESSION["lang"];
	}
	if($lang == "ar") require_once("messages_ar.php");
	else require_once("messages_en.php");

    //to make sure users only access the page , not anyone
    if(empty($_SESSION["user"])){
        header("location:index.php?errors=secure_page");
    }else{
        $user = $_SESSION["user"];
        
        //only admins can enter users_create.php , users.php  pages
        if(($active == "Users Create" || $active == "Users List") && $user["role"] != "admin"){
            session_unset();
            header("location:index.php?errors=secure_page");
        }

        //solving path problem 
        if(!empty($active) && $active == "Post Edit"){
            $path = "../";
        }else{
            $path = "";
        }
    }

?>
<!DOCTYPE html>
<html lang="<?=$lang?>" dir = "<?=$messages["dir"]?>">
<head>
	<title><?= $active?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?=$path?>images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=$path?>vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="<?=$path?>fonts/font-awesome-4.7.0/css/font-awesome.min.css"> -->
	<link rel="stylesheet" type="text/css" href="<?=$path?>fonts/fontawesome-free-6.1.1-web/css/all.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=$path?>vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=$path?>vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=$path?>vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=$path?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=$path?>css/main.css">
<!--===============================================================================================-->
</head>
<body style="background: linear-gradient(-135deg, #c850c0, #4158d0);">

<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand mx-3" href="<?=$path?>home.php">BLOG</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        
       
        <ul class="navbar-nav <?=$messages["mr"]?>-auto">
            <li class="nav-item <?php if($active == "home") echo "active"?>">
                <a class="nav-link" href="<?=$path?>home.php"><?=$messages["Home"]?></a>
            </li>

            <?php 
            if($user["role"] == "admin"){
            ?>
                <!-- users dropdown-->
                <li class="nav-item dropdown <?php if($active == "Users Create") echo "active"?>">
                    <a class="nav-link dropdown-toggle" href="" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$messages["Users"]?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="<?=$path?>users_create.php"><?=$messages["Add User"]?></a>
                        <a class="dropdown-item" href="<?=$path?>users.php"><?=$messages["Users List"]?></a>
                    </div>
                </li>
            <?php   
            }   
            ?>
        </ul>
       

        <ul class="navbar-nav  <?=$messages["ml"]?>-auto">
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle text-success mx-2 " href="home.php" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$_SESSION["user"]["name"]?></a>
                <div class="dropdown-menu  " aria-labelledby="dropdownId">
                    <?php 
                        if($lang == "en"){
                    ?>
                        <a class="dropdown-item text-success" href="<?=$path?>change_lang.php?lang=ar"><strong>اللغة العربية</strong></a>
                    <?php        
                        }else{
                    ?>
                     <a class="dropdown-item text-success" href="<?=$path?>change_lang.php?lang=en"><strong>English</strong></a>
                    <?php
                        }
                    ?>
                    <a class="dropdown-item text-success " href="<?=$path?>logout.php"> <strong><?=$messages["Logout"]?></strong> </a>
                </div>
            </li>
        </ul>
       
    </div>
</nav>