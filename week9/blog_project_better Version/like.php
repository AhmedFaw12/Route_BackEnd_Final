<?php
session_start();
require_once("config.php");

if(!empty($_SESSION["user"])){
    $user = $_SESSION["user"];
}else{
    header("location:index.php?errors=secure_page");
}

//check inputs
if(empty($_REQUEST["reaction"])){
    $error["reaction"] = "Reaction is Required";
}

if(empty($_REQUEST["post_id"])){
    $error["post_id"] = "Post Id is Required";
}

$like_reactions = ["like", "love"];
$dislike_reactions = ["dislike", "unlove"];

if(empty($errors)){
    $reaction_type = strip_tags(trim($_REQUEST["reaction"]));
    $post_id = strip_tags(trim($_REQUEST["post_id"]));
    echo $reaction_type;
    $cn  = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, PORT);
    //unlike
    if(in_array($reaction_type,$dislike_reactions)){

        $qry = "delete from likes where post_id=$post_id and user_id=".$user["id"];
        $rslt = mysqli_query($cn, $qry);
        

    }else if(in_array($reaction_type,$like_reactions)){ //like
        //if already liked before then delete this like then insert the new one
        $qry = "select type from likes where post_id=$post_id and user_id=".$user["id"];
        $rslt = mysqli_query($cn, $qry);
        if($row = mysqli_fetch_assoc($rslt)){
            $qry2 = "delete from likes where post_id=$post_id and user_id=".$user["id"];
            $rslt2 = mysqli_query($cn, $qry2);
        }

        $qry = "insert into likes(type,post_id,user_id) values('$reaction_type' ,$post_id, ".$user["id"].")";
        $rslt = mysqli_query($cn, $qry);
        
    }
    header("location:home.php");

}else{

}
