<?php

namespace TechStore\Classes\Validation;

use TechStore\Classes\Validation\ValidationRule;

class RequiredFile implements ValidationRule 
{
    public function check(string $name, $value) :bool|string{
        if($value['error'] != 0){
            return "$name is required";   
        }
        return false;
    }
        
}

