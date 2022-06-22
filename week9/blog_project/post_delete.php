<?php
//check for user session
session_start();
if(!empty($_SESSION["user"])){

    $user = $_SESSION["user"];
    
    //filter and validate
    if(empty($_GET["post_id"])){
        header("location:home.php?error=Invalid_delete_operation");
    }else{
        $post_id = strip_tags(trim($_GET["post_id"]));
        
        
        require_once("config.php");
        
        $cn = mysqli_connect(HOST_NAME,DB_USER_NAME,DB_PW, DB_NAME, DB_PORT);
        
        //select the image to delete it, checking if created_by == user["id"] and user['role] !=admin
        if($user['role'] != "admin") {
            $cond =  "and created_by = ". $user['id'];
        }else{
            $cond = "";
        }
    
        
        $qry = "select image from posts where id = $post_id $cond";
        
        
        $rslt = mysqli_query($cn, $qry);

        if($row = mysqli_fetch_assoc($rslt)){
            unlink($row["image"]);//delete image
            
            //deleting post from database
            $qry = "delete from posts where id = $post_id";
            $rslt = mysqli_query($cn, $qry);
        }

        
        // echo mysqli_error($cn);
        mysqli_close($cn);
        header("location:home.php");
    }
}else{
    header("location:index?error=secure_page");
}