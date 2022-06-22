<?php
session_start();
require_once("../config.php");

//only admin , editors can delete posts
if(!empty($_SESSION["user"]) && ($_SESSION["user"]["role"] == "admin" || $_SESSION["user"]["role"] == "editor")){
    $user = $_SESSION["user"];
}else{
    session_unset();
    header("location:../index.php?errors=secure_page");
}

//check and validate inputs
$errors = [];

if(empty($_GET["post_id"])){
    $errors = ["delete" => "Invalid Delete Operation"];
    $_SESSION["errors"] = $errors;
    header("location:../home.php");
}else{
    $post_id = strip_tags(trim($_GET["post_id"]));
    
    $cn  = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, PORT);
    //only admin or post owner can delete post
    if($user['role'] != "admin"){
        $cond = "and created_by = ". $user['id'];
    }else{
        $cond = "";
    }

    //deleting image of the post
    $qry = "select image from posts where id = $post_id $cond" ;
    $rslt = mysqli_query($cn, $qry);
    // var_dump(mysqli_error($cn));
    
    if($row = mysqli_fetch_assoc($rslt)){
        unlink("../".$row["image"]);

        //deleting post from database
        $qry = "delete from posts where id = $post_id";
        $rslt = mysqli_query($cn, $qry);

    }else{
        $errors = ["delete" => "Post Not Found or Not Authorized"];
        $_SESSION["errors"] = $errors;
        header("location:../home.php");
    }

    mysqli_close($cn);
    header("location:../home.php");
}

