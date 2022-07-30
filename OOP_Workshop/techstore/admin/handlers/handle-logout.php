<?php  

use TechStore\Classes\Models\Admin;

require_once("../../app.php");

if(!$session->has("success")){
    $adminName = $session->get("adminName");
    $session->set("success", "GoodBye $adminName");
}

$ad = new Admin;
$ad->logout($session);

$request->aredirect("login.php");
?>