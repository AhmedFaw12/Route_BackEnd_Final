<?php

use TechStore\Classes\Models\Cat;
use TechStore\Classes\Validation\Validator;

require_once("../../app.php");

if($request->postHas("submit")){

    $id = $request->post("id");
    $name = $request->post("name");

    //validate
    $validator = new Validator;
    $validator->validate("id", $id, ["required", "numeric"]);
    $validator->validate("name", $name, ["required", "str", "max"]);
    
    if($validator->hasErrors()){
        
        $session->set("errors", $validator->getErrors());
        $request->aredirect("categories.php");
    }else{

        $c = new Cat;
        $c->update("name = '$name'", $id);

        $session->set("success", "category updated successfully");
        $request->aredirect("categories.php");
    }

}else{
    $request->aredirect("edit-category.php");
}

?>