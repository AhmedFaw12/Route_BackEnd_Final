<?php
//get user id and check if it is empty
session_start();
if(!empty($_SESSION["user"]) && ($_SESSION["user"]["role"] == "admin" || $_SESSION["user"]["role"] == "editor")){
    $user = $_SESSION["user"];
}else{
    header("location:index.php?error=secure_page");
}

//we should filter and validate
$errors = [];

if(empty($_POST["title"])){
    $errors["empty_title"] = "title is required";
}else{

}
if(empty($_POST["body"])){
    $errors["empty_body"] = "body is required";
}else{

}

if(empty($_FILES["image"])){
    $errors["empty_image"] = "Image is required";
}

// Check if the image file is JPEG or PNG.
$allowed_extensions = ['png', 'jpg', 'jpeg'];
$file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
if(!in_array($file_extension, $allowed_extensions)){
    $errors["Invalid_img_extension"] = "Upload valid images. Only PNG and JPEG are allowed.";
}


$title = strip_tags(trim($_POST["title"]));
$body = strip_tags(trim($_POST["body"]));


if(empty($errors)){

    //moving file with a new unique name to another location
    $file_name = "images/posts/" . date("YmdHis")."_" .$user["id"] . "." . pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION);
    
    move_uploaded_file($_FILES["image"]["tmp_name"], $file_name);
    
    //check if user is admin ,then make status approved else pending
    if($user["role"] == "admin" ) $status = "approved";
    else $status = "pending";

    //saving post in the database
    $qry = "insert into posts(title, body, image, created_by,status) values ('$title', '$body', '$file_name'," .$user['id']. ", '$status')";

    require_once("config.php");
    
    $cn = mysqli_connect(HOST_NAME,DB_USER_NAME,DB_PW, DB_NAME, DB_PORT);
    
    $rslt = mysqli_query($cn, $qry);

    
    // echo mysqli_error($cn);
    mysqli_close($cn);
    header("location:home.php");
}else{

}