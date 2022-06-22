<?php
session_start();
require_once("config.php");
if(!empty($_SESSION["user"])){
    $user = $_SESSION["user"];
}else{
    header("location:index.php?errors=secure_page");
}


$errors = [];
if(empty($_REQUEST["post_id"])){
    $errors["post"] = "Empty Post id";
}

if(empty($_REQUEST["comment_id"])){
    $errors["comment"] = "Comment Id Is Required";
}

if(empty($_REQUEST["comment"])){
    $errors["comment"] = "Comment Is Required";
}

$post_id = strip_tags(trim($_REQUEST["post_id"]));
$comment_id = strip_tags(trim($_REQUEST["comment_id"]));
$comment = strip_tags(trim($_REQUEST["comment"]));

var_dump($_REQUEST);
if(empty($errors)){

    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, PORT);

    $qry = "select id, comment from comments where id = $comment_id and post_id = $post_id and user_id =" . $user["id"];
    $rslt = mysqli_query($cn, $qry);

    var_dump(mysqli_error($cn));
    if($row = mysqli_fetch_assoc($rslt)){
        $qry = "update comments set comment = '$comment' where id = $comment_id and post_id = $post_id and user_id =" . $user["id"];
        $rslt = mysqli_query($cn, $qry);
        var_dump(mysqli_error($cn));

        header("location:home.php?success");

        mysqli_close($cn);
    }else{
        mysqli_close($cn);
        $errors["comment"] = "Invalid Comment Edit Operation";
        $_SESSION["errors"] = $errors;
        header("location:home.php");
    }

}else{
    var_dump($errors);
    $_SESSION["errors"] = $errors;
    header("location:home.php");
}