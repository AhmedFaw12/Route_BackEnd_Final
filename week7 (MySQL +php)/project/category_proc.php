<?php

var_dump($_POST);

//check if name is empty
if(!empty($_POST["name"])){

    //validate and filter 

    $name = $_POST["name"];

    //connect to database

    // require because this file is important
    // if write this require again , it will give error because config.php contains constants which can not be defined twice, so we should use require_once

    //so require_once will not give error , if i write it many times
    require("config.php"); 

    $qry = "insert into categories(name) value('$name')";

    $cn = mysqli_connect(HOST_NAME, DB_UN, DB_PW, DB_NAME, DB_PORT);

    $rslt = mysqli_query($cn, $qry);
    if($rslt){
        header("location:cats.php?msg=insert_done");
    }else{
        //. for concatination
        header("location:cats.php?error=" . mysqli_error($cn));
    }

    mysqli_close($cn);

}else{

    //if empty name then go to cats page with message
    header("location:cats.php?error=empty");
}