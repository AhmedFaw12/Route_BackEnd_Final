<?php
session_start();
require_once("../config.php");

//check user session 
//admins only enter this page
if(!empty($_SESSION["user"]) && $_SESSION["user"]["role"] == "admin"){
    $user = $_SESSION["user"];
}else{
    session_unset();
    header("location:../index.php?errors=secure_page");
}

//check validate inputs and make sure that action = "approved" or "rejected"
$errors = [];
if(empty($_GET["post_id"]) || (empty($_GET["action"]) || !($_GET["action"] =="approved" || $_GET["action"] =="rejected"))){
    $errors["approve_reject"] = "Invalid (Approve/Reject) Operation";
}


if(empty($errors)){
    $post_id = strip_tags(trim($_GET["post_id"]));
    $action = strip_tags(trim($_GET["action"]));

    $cn  = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, PORT);
    //check if post exists
    $qry = "select id,status from posts where id = $post_id";
    $rslt = mysqli_query($cn, $qry);



    if($row = mysqli_fetch_assoc($rslt)){
        //check if post already approved or rejected
        if($row["status"] == "pending"){
            //update post
            $qry = "update posts set status = '$action', action_by = ".$user["id"]." where id = $post_id";
            $rslt = mysqli_query($cn, $qry);
            var_dump(mysqli_error($cn));
        }else{
            if ($row["status"] == "approved"){
                $errors["approve_reject"] = "Post Is Already Approved";   
            }else{
                $errors["approve_reject"] = "Post Is Already Rejected";
            }
            $_SESSION["errors"] = $errors;
            header("location:../home.php");
        } 
    }else{
        mysqli_close($cn);

        $errors["approve_reject"] = "Post Not found";
        $_SESSION["errors"] = $errors;
        header("location:../home.php");
    }

    mysqli_close($cn);
    header("location:../home.php");

}else{
    $_SESSION["errors"] = $errors;
    header("location:../home.php");
}