<?php
session_start();
require_once("../config.php");

//only admins and editors can create posts
if(!empty($_SESSION["user"]) && ($_SESSION["user"]["role"] == "admin" || $_SESSION["user"]["role"] == "editor")){
    $user = $_SESSION["user"];
}else{
    session_unset();
    header("location:../index.php?errors=secure_page");
}


//filter and validate inputs
$errors = [];
$old_values = ["post_title"=>null, "post_body"=>null];


if(empty($_REQUEST["title"])){
    $errors["post_title"] = "Post Title Is Required";
}else{
    $old_values["post_title"] = $_REQUEST["title"];
}

if(empty($_REQUEST["body"])){
    $errors["post_body"] = "Post Body Is Required";
}else{
    $old_values["post_body"] = $_REQUEST["body"];
}

if($_FILES['image']['size'] == 0){
    $errors["post_image"] = "Post Image Is Required";
}

$post_title = strip_tags(trim($_REQUEST["title"]));
$post_body = strip_tags(trim($_REQUEST["body"]));


//check extension of image
$allowed_extension = ["png", "jpg", "jpeg"];
$file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

if(empty($errors["post_image"]) && !in_array($file_extension, $allowed_extension)){
    $errors["post_image"] = "Extension Must be :png , jpg, jpeg only";
}


if(empty($errors)){
    
    //moving image to posts folder
    $filename = "images/posts/" .date("YmdHis") . $_SESSION["user"]["id"] ."." . pathinfo($_FILES["image"]["name"],  PATHINFO_EXTENSION)  ; 
    
    move_uploaded_file($_FILES["image"]["tmp_name"], "../".$filename);

    if($_SESSION["user"]["role"] == "admin") $status ="approved";
    else $status ="pending";
    
    //creating post in DB
    $qry = "insert into posts(title, body, image, created_by, status) values('$post_title', '$post_body', '$filename'," .$user["id"] .", '$status' )";
    
    $cn  = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, PORT);
    $rslt = mysqli_query($cn, $qry);
    if($rslt){
        if($status == "approved"){
            $_SESSION["success"] = ["approved"=>"Post Is Created Successfully"];
        }else if($status == "pending"){
            $_SESSION["success"] = ["pending"=>"Post Is Pending"];
        }
        header("location:../home.php");
    }else{
        var_dump(mysqli_error($cn));
    }
    mysqli_close($cn);
}else{
    $_SESSION["errors"] = $errors;
    $_SESSION["old_values"] = $old_values;
       
    header("location:../home.php");
}