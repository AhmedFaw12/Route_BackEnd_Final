<?php
session_start();
require_once("../config.php");

//only admins and editors can Enter this page
if(!empty($_SESSION["user"]) && ($_SESSION["user"]["role"] == "admin" || $_SESSION["user"]["role"] == "editor")){
    $user = $_SESSION["user"];
}else{
    session_unset();
    header("location:../index.php?errors=secure_page");
}


//filter and validate inputs
$errors = [];

if(empty($_REQUEST["post_id"])){
    $errors["post_id"] = "Post Id Is Required";
}

if(empty($_REQUEST["title"])){
    $errors["post_title"] = "Post Title Is Required";
}

if(empty($_REQUEST["body"])){
    $errors["post_body"] = "Post Body Is Required";
}

$post_id = strip_tags(trim($_REQUEST["post_id"]));
$post_title = strip_tags(trim($_REQUEST["title"]));
$post_body = strip_tags(trim($_REQUEST["body"]));

if(empty($errors)){
    //getting old image
    $qry = "select image from posts where id = $post_id and created_by =". $user["id"];
    
    $cn  = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, PORT);
    $rslt = mysqli_query($cn, $qry);
    if($post = mysqli_fetch_assoc($rslt)){
        $filename = $post["image"];
    }else{
        mysqli_close($cn);
        $errors["edit"] = "Invalid Edit Operation";
        $_SESSION["errors"] = $errors;   
        header("location:edit.php?post_id=$post_id");
    }


    if(!empty($_FILES["image"]["name"])){
        //check extension of image
        $allowed_extension = ["png", "jpg", "jpeg"];
        $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        
        if(empty($errors["post_image"]) && !in_array($file_extension, $allowed_extension)){
            $errors["post_image"] = "Extension Must be :png , jpg, jpeg only";
            $_SESSION["errors"] = $errors;   
            header("location:post_edit.php?post_id=$post_id");
        }

        unlink("../".$filename);
        
        //moving image to posts folder
        $filename = "images/posts/" .date("YmdHis") . $_SESSION["user"]["id"] ."." . pathinfo($_FILES["image"]["name"],  PATHINFO_EXTENSION)  ; 
        
        move_uploaded_file($_FILES["image"]["tmp_name"], "../".$filename);
    }    

    if($user["role"] == "admin") $status ="approved";
    else $status ="pending";
    
    $qry = "update posts set title = '$post_title', body ='$post_body', image ='$filename' ,status = '$status' where id = $post_id and created_by =". $user["id"] ;

    $rslt = mysqli_query($cn, $qry);
    if($rslt){
        if($status == "approved"){
            $_SESSION["success"] = ["approved"=>"Post Is Edited Successfully"];
        }else if($status == "pending"){
            $_SESSION["success"] = ["pending"=>"Post Edit Is Pending"];
        }
        header("location:post_edit.php?post_id=$post_id");
    }else{
        var_dump(mysqli_error($cn));
    }
    mysqli_close($cn);
}else{
    $_SESSION["errors"] = $errors;   
    header("location:post_edit.php?post_id=$post_id");
}
