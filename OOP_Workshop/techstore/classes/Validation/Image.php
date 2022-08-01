<?php

namespace TechStore\Classes\Validation;

use TechStore\Classes\Validation\ValidationRule;

class Image implements ValidationRule 
{
    public function check(string $name, $value) :bool|string{
        $allowedExt = ["jpg", "png", "jpeg", "gif"];
        $ext = pathinfo($value["name"], PATHINFO_EXTENSION);
        
        if(!in_array($ext, $allowedExt)){
            return "$name extension is not allowed, please upload jpg,jpeg,png,gif";   
        }
        return false;
    }
        
}

