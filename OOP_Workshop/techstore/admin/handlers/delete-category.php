<?php

use TechStore\Classes\Models\Cat;

require_once("../../app.php");

if($request->getHas("id")){
    $id = $request->get("id");
    
    $c = new Cat;
    $cat = $c->selectId($id);
    
    if(isset($cat)){
        $c->delete($id);
    }else{
        $session->set("errors", ["Category not found"]);
    }
    $session->set("success", "category deleted successfully");
    $request->aredirect("categories.php");
}else{
    $request->aredirect("categories.php");
}

?>  