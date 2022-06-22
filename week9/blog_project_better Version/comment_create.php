<?php
session_start();
require_once("config.php");

// only users enter this page 
if(!empty($_SESSION["user"])){
    $user = $_SESSION["user"];
}else{
    header("location:index.php?errors=secure_page");
}

$errors = [];
if(empty($_REQUEST["post_id"])){
    $errors["post"] = "Empty Post id";
}

if(empty($_REQUEST["comment"])){
    $errors["comment"] = "Comment Is Required";
}

$post_id = strip_tags(trim($_REQUEST["post_id"]));
$comment = strip_tags(trim($_REQUEST["comment"]));

if(empty($errors)){

    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, PORT);
    //check if post exists
    $qry = "select id from posts where id = $post_id";
    $rslt = mysqli_query($cn, $qry);
    
    if($row = mysqli_fetch_assoc($rslt)){
        $qry = "Insert into comments(comment, user_id, post_id) values('$comment', ".$user["id"].", $post_id)";
        $rslt = mysqli_query($cn, $qry);
        mysqli_close($cn);
        header("location:home.php?success");
    }else{
        mysqli_close($cn);
        $errors["post"] = "Post Does not Exists";
        $_SESSION["errors"] = $errors;
        header("location:home.php");
    }

}else{
    
    $_SESSION["errors"] = $errors;
    header("location:home.php");
}