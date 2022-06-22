<?php
//starting session
session_start();
echo session_id();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row m-5">
            <div class="col-md-12">
                <?php 
                    //reading 
                   if(!empty($_SESSION["user_name"]) && !empty($_SESSION["user_age"])){
                        echo "<h1>", $_SESSION["user_name"], " your Age is ", $_SESSION["user_age"], "</h1>";
                    }else {
                        // header to redirect to login.php
                        header("location:login.php");
                    }
                ?>
            </div>
        </div>
    </div>
    
</body>
</html>