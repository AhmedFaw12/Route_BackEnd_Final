<?php
namespace TechStore\Classes\Validation;

class Required implements ValidationRule{
    public function check(string $name, $value):string|bool{
        if(empty($value)){
            return "$name is required";
        }
        return false;    
    }
}