<?php
namespace TechStore\Classes\Validation;
class Max implements ValidationRule{
    public function check(string $name, $value):string|bool{
        if(strLen($value) > 255){
            return "$name must not exceed 255 characters";
        }
        return false;    
    }
}