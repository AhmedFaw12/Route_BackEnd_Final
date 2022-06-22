<?php
//check for user session
session_start();
if (!empty($_SESSION["user"]) && $_SESSION["user"]['role'] == 'admin') {

    $user = $_SESSION["user"];

    // validate and check inputs
    $post_id = strip_tags(trim($_GET["post_id"])); 
    $action = strip_tags(trim($_GET["action"]));

    require_once("config.php");

    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);

    //setting status and action_by
    $qry = "update posts set status='$action',action_by =". $user["id"]. " where id = $post_id";


    $rslt = mysqli_query($cn, $qry);
    echo mysqli_error($cn);
    mysqli_close($cn);
    header("location:home.php");
} else {
    header("location:index?error=secure_page");
}
