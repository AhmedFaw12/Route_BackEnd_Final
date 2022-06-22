<?php
session_start();
if(!empty($_REQUEST["lang"])){
    $_SESSION["lang"] = $_REQUEST["lang"];
}else{
    $_SESSION["lang"] = "en";
}
// var_dump($_SERVER);

header("location:{$_SERVER["HTTP_REFERER"]}");
