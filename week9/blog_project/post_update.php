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

if(empty($_POST["post_id"])){
    $errors["empty_id"] = "id is required";
}

if(empty($_POST["title"])){
    $errors["empty_title"] = "title is required";
}else{

}
if(empty($_POST["body"])){
    $errors["empty_body"] = "body is required";
}




$post_id = strip_tags(trim($_POST["post_id"]));//getting post_id
$title = strip_tags(trim($_POST["title"]));
$body = strip_tags(trim($_POST["body"]));

// echo $title, $body, $post_id;

if(empty($errors)){

    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME,DB_USER_NAME,DB_PW, DB_NAME, DB_PORT);
    $qry = "select id , image from posts where id = $post_id";

    $rslt = mysqli_query($cn, $qry);
    if($row = mysqli_fetch_assoc($rslt)){

        $file_name  = $row['image'];
    }

    if(!empty($_FILES["image"]["name"])){
        
        // Check if the image file is JPEG or PNG.
        $allowed_extensions = ['png', 'jpg', 'jpeg'];
        $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        if(!in_array($file_extension, $allowed_extensions)){
            $errors["Invalid_img_extension"] = "Upload valid images. Only PNG and JPEG are allowed.";
            $_SESSION["errors"] = $errors;
             header("location:post_edit.php?post_id=$post_id");
        }
        
        unlink($file_name);//deleting old image

        //moving file with a new unique name to another location
        $file_name = "images/posts/" . date("YmdHis")."_" .$user["id"] . "." . pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION);
        
        move_uploaded_file($_FILES["image"]["tmp_name"], $file_name);
    }
    
    
    //check if user is admin ,then make status approved else pending
    if($user["role"] == "admin" ) $status = "approved";
    else $status = "pending";

    //updating post in the database
    $qry = "update posts set title = '$title',body =  '$body', image= '$file_name', status = '$status' where id = $post_id and created_by = " .$user['id'];
    
    $rslt = mysqli_query($cn, $qry);
    // echo mysqli_error($cn);
    mysqli_close($cn);
    header("location:post_edit.php?post_id=$post_id");
}else{
    $_SESSION["errors"] = $errors;
    header("location:post_edit.php?post_id=$post_id");
}