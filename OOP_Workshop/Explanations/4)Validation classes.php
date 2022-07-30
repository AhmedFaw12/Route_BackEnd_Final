<?php
/*
Validation Classes:
    -validation will be multiple classes
    
    -What are validation classes that we make?
        Class for each Validation Rule:
            -Required (or not)
            -Str (to check if something is string or not)
            -Numeric (to check if something is numeric or not)
            -Email (to check if something is email or not)
            -Max (to check if input value string length exceeded 255(number we write while making tables varchars) characters or not)

            
            -->these classes will have function check() that takes input name, its value and in case of error , it will return error, in case of no error it will return false(as no error)

            -->so we will make interface ValidationRule that has check() method not implemented , and validation classes will implement ValidationRule

        -Main Class(Validator):
            -it will perform validation practicly
            -it will call the suitable validation rule class

            Example:
                age 25
                required|numeric

    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    Example:
        classes/Validation/ValidationRule.php:
            <?php

            interface ValidationRule{
                public function check(string $name, $value);
            }

        classes/Validation/Required.php:
            <?php

            class Required implements ValidationRule{
                public function check(string $name, $value):string|bool{
                    if(empty($value)){
                        return "$name is required";
                    }
                    return false;    
                }
            }
            
            -required : to check if input value is empty or not
            -it will implements ValidationRule Interface
            -if empty , it will return $name(ex:age) is required

            -if not empty , it will return false(not empty)
        
        classes/Validation/Str.php:
            <?php

            class Str implements ValidationRule{
                public function check(string $name, $value):string|bool{
                    if(!is_string($value)){
                        return "$name must be string";
                    }
                    return false;    
                }
            }
            -Str : to check if input value is string or not
            -we named class Str , because String is a reserved word in php
        
        classes/Validation/Numeric.php:
            <?php

            class Numeric implements ValidationRule{
                public function check(string $name, $value):string|bool{
                    if(!is_numeric($value)){
                        return "$name must contain only numbers";
                    }
                    return false;    
                }
            }
        
        classes/Validation/Email.php:
            <?php

            class Email implements ValidationRule{
                public function check(string $name, $value):string|bool{
                    if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                        return "$name must be valid email";
                    }
                    return false;    
                }
            }

        classes/Validation/Max.php:
            <?php    

            class Max implements ValidationRule{
            public function check(string $name, $value):string|bool{
                    if(strLen($value) > 255){
                        return "$name must not exceed 255 characters";
                    }
                    return false;    
                }
            }

            -Max:to check if input value string length exceeded 255(number we write while making tables varchars) characters or not
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        classes/Validation/Validator.php:
            -this class will validate the input and call validaion rules classes
            
            <?php

            class Validator{
                private $errors = [];

                public function validate(string $name, $value, array $rules):void{
                    foreach ($rules as $rule) {
                        $obj = new $rule;

                        // if($rule == "required"){
                        //     $obj = new Required() ;
                        // }elseif($rule == "numeric"){
                        //     $obj = new Numeric() ;
                        // }elseif($rule == "max"){
                        //     $obj = new Max() ;
                        // }elseif($rule == "email"){
                        //     $obj = new Email() ;
                        // }

                        $error = $obj->check($name, $value);
                        if($error !== false){
                            $this->errors[] = $error;
                            break;
                        }
                    }
                }

                -we will loop through validation rules that user entered
                -make object from that rule class :
                    // if($rule == "required"){
                    //     $obj = new Required() ;
                    // }elseif($rule == "numeric"){
                    //     $obj = new Numeric() ;
                    // }elseif($rule == "max"){
                    //     $obj = new Max() ;
                    // }elseif($rule == "email"){
                    //     $obj = new Email() ;
                    // }
                    
                    -if there is a new rule , we will have to add an else if

                    -so we violated OpenClose solid principle(2nd principle) which says that we shouldn't modify class
                    
                    -so we have to find another way where we don't use else if

                    -we will take advantage of (rule name == class name) and create objects with dynamic names:
                        $obj = new $rule;

                    -Classnames in PHP are not case sensitive :
                        ex: new Required is same as new required
 
                -then we will use check() to validate input according to the rule

                -if there is error , we will put in errors array and break from the loop,so not to validate input for more errors 
                
                -we will not return anything, so return type is void


                public function getErrors():array{
                    return $this->errors;
                }
                
                -Encapsulation function to get errors array since $errors property is private 

                -return type is array

                public function hasErrors():bool{
                   
                    return !empty($this->errors);
                }

                -function to check if errors array has errors or not
                -if not empty -->return true(has errors)
                -return type is bool
            }


            
            
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        test.php:
            require_once("classes/Validation/ValidationRule.php");
            require_once("classes/Validation/Required.php");
            require_once("classes/Validation/Numeric.php");
            require_once("classes/Validation/Max.php");
            require_once("classes/Validation/Str.php");
            require_once("classes/Validation/Email.php");
            require_once("classes/Validation/Validator.php");


            $v = new Validator();
            $v->validate('age', '', [
                'required', 'numeric'
            ]);

            $v->validate('name', '', [
                'required', 'string', 'max'
            ]);


            echo '<pre>';
            print_r($v->getErrors());
            // var_dump($res);
            echo '</pre>';


            
            
*/

