<?php
namespace TechStore\Classes\Validation;

class Numeric implements ValidationRule{
    public function check(string $name, $value):string|bool{
        if(!is_numeric($value)){
            return "$name must contain only numbers";
        }
        return false;    
    }
}