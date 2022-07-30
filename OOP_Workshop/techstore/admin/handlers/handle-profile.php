<?php  
require("../../app.php");

use TechStore\Classes\Models\Admin;
use TechStore\Classes\Validation\Validator;

if($request->postHas('submit') ){
    
    $name = $request->post("name");
    $email = $request->post("email");
    $password = $request->post("password");
    $password_confirmation = $request->post("password_confirmation");

    //validation
    $validator = new Validator;
    
    $validator->validate("name", $name, ["required","str", "max"]);
    $validator->validate("email", $email, ["required","email", "max"]);

    if(!empty($password) && $password === $password_confirmation){
        $validator->validate("password", $password, ["required", "str", "max"]);
    }
    
    if($validator->hasErrors()){
        $session->set("errors", $validator->getErrors());
        $request->aredirect("profile.php");
        
    }else{
        
        $ad =  new Admin;
        
        if(!empty($password)){
            //update query with password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $ad->update("name = '$name', email = '$email', `password` = '$hashedPassword'", $session->get("adminId"));
        }else{
            //update query without password
            $ad->update("name = '$name', email = '$email'", $session->get("adminId"));
        }
        $session->set("success", "Profile is edited Successfully");
        $request->aredirect("handlers/handle-logout.php");
    }

}else{
    $request->aredirect("login.php");
}
?>