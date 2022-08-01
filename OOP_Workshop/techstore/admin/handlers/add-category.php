<?php

use TechStore\Classes\Models\Cat;
use TechStore\Classes\Validation\Validator;

require_once("../../app.php");

if($request->postHas("submit")){

    $name = $request->post("name");
    
    //validate
    $validator = new Validator;
    $validator->validate("name", $name, ["required", "str", "max"]);

    if($validator->hasErrors()){
        $session->set("errors", $validator->getErrors());
        $request->aredirect("categories.php");
    }else{
        $c = new Cat;
        $c->insert("name","'$name'");

        $session->set("success", "category added successfully");
        $request->aredirect("categories.php");   
    }
}else{
    $request->aredirect("categories.php");
}

?>