<?php
namespace TechStore\Classes\Validation;

class Str implements ValidationRule{
    public function check(string $name, $value):string|bool{
        if(!is_string($value)){
            return "$name must be string";
        }
        return false;    
    }
}
