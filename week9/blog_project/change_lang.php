<?php

session_start();

if(!empty($_REQUEST["lang"])){
    if($_REQUEST["lang"] == "en"){
        $_SESSION["lang"] = "en";
    }else{
        $_SESSION["lang"] = "ar";
    }
}else{
    $_SESSION["lang"] = "en"; //default is english
}
header("location:" .$_SERVER["HTTP_REFERER"]);// go to the page that called me