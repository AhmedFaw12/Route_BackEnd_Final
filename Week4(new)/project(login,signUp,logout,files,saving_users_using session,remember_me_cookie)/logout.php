<?php

session_start();

// unset($_SESSION["user_data"]);
// $_SESSION["user_data"] = null;
// session_unset();

session_destroy();

setcookie("user", null, time() - 3600);
header("location:index.php");
