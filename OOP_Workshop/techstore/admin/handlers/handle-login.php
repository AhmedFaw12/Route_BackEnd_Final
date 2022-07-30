<?php  
require("../../app.php");

use TechStore\Classes\Models\Admin;
use TechStore\Classes\Validation\Validator;

if($request->postHas('submit') ){
    
    $email = $request->post("email");
    $password = $request->post("password");

    //validation
    $validator = new Validator;
    
    $validator->validate("email", $email, ["required","email", "max"]);
    $validator->validate("password", $password, ["required", "str", "max"]);
       
    
    if($validator->hasErrors()){
        $session->set("errors", $validator->getErrors());
        $request->aredirect("login.php");
    }else{
        
        $ad =  new Admin;
        $isLogin = $ad->login($email, $password, $session);
        
        if($isLogin){
            $session->set("success", "You logged in Successfully");
            $request->aredirect("index.php");
        }else{
            $session->set("errors", ["Credentials are not correct"]);            
            $request->aredirect("login.php");
        }
    }

}else{
    $session->set("errors", ["Please Login First"]);  
    $request->aredirect("login.php");
}
?>