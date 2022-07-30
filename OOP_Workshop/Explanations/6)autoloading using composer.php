<?php
/*
Autoloading using Composer:
    -autoloading helps me in big projects ,where we need to require many many files
    -so instead of require these files manually, we will use autoloading

    -autoloading can be done in many ways
    -best way to make autoloading is by using composer
    
    -composer is dependany manager for php like npm for javascripts
    -we will put our dependany in composer.json like package.json in npm
    -npm download files in node_module folder
    -composer download files in vendor folder 

    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    Steps of autoloading:
        -so download and install composer
        -make composer.json and make namepaces:
            -where we will put our dependancies
            -we will put anything we require(dependancies) in development under key called "require-dev" 
            -we will put anything we require in production

            -we will just use composer in autoloading

            -so inorder to make autoloading , we have to follow php standards(psr) in the folder(classes) on which we will apply autoloading

            -we will follow psr-4 (php standards recommendations)
            -so we have to make namespace with certain naming convention(according to psr-4) in classes folder 

            Example:
                -classes(request, session, Db) inside classes folder directly will have namespace:
                    namespace TechStore\Classes
                
                -while classes that are inside another subfolder , we will add their subfolder name in the namespace:
                    namespace TechStore\Classes\Subfolder
                    
                classes\Db.php:
                    namespace TechStore\Classes;
                classes\Request.php:
                    namespace TechStore\Classes;
                classes\Session.php:
                    namespace TechStore\Classes;


                classes\Models\Cat.php:
                    namespace TechStore\Classes\Models;
                    use TechStore\Classes\Db;
                    
                    -since we are inheriting Db class 
                    -we have to use its namespaces

                classes\Models\Order.php:
                    namespace TechStore\Classes\Models;
                    use TechStore\Classes\Db;

                classes\Models\OrderDetail.php:
                    namespace TechStore\Classes\Models;
                    use TechStore\Classes\Db;

                classes\Models\Product.php:
                    namespace TechStore\Classes\Models;
                    use TechStore\Classes\Db;

                classes\Validation\Email.php:
                    namespace TechStore\Classes\Validation;
                classes\Validation\Max.php:
                    namespace TechStore\Classes\Validation;
                classes\Validation\Numeric.php:
                    namespace TechStore\Classes\Validation;
                classes\Validation\Required.php:
                    namespace TechStore\Classes\Validation;
                classes\Validation\Str.php:
                    namespace TechStore\Classes\Validation;
                classes\Validation\ValidationRule.php:
                    namespace TechStore\Classes\Validation;
                classes\Validation\Validator.php:
                    namespace TechStore\Classes\Validation;
                
                app.php:
                    use TechStore\Classes\Request;
                    use TechStore\Classes\Session;


                    $request = new Request();
                    $session = new Session();
                
                    -we have to use request , session namespaces inorder to use them
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        -Autoload:
            -autoloading decrease these require lines(in app.php) into only one line   
            -we will just require the file that will require all of these classes automatically

            -autoloader function:
                -once i used any class ,autoloader require this class
                -also if we added new classes in classes folder and followed the name standards, autoloader also reads these classes and can require it
            
            
            steps:
                -we will make a key called "autoload" and inside it ,we will make another key ("psr-4") determing the way/method of autoload
                
                -inside psr-4 , we will make key and value
                -key is the namespace we want, value is the name of the folder:
                    "TechStore\Classes\" :"classes/"

                -but the writing \ inside double quotes causes escaping and errors
                -so we put double backslashes:
                    "TechStore\\Classes\\" :"classes/"
                
            Example:
                composer.json:
                    {
                        "autoload":{
                            "psr-4": {
                                "TechStore\\Classes\\" :"classes/"
                            }
                        }
                    }
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        -Run:
            -we need to run autoload        
            -in terminal inside our project folder(techstore):
                composer dump-autoload
            
            -it will create vendor folder which contain (autoload.php)

            -in app.php we will remove all requires and require only this autoload.php

            Example:
                command : composer dump-autoload
                app.php:
                    require_once(PATH."vendor/autoload.php");


                    -we don't need to require any of the classes files anymore
                
                test.php:
                    require_once("app.php");

                    echo $request->get("name");

                    in url:http://localhost/OOP_Workshop/techstore/test.php?name=Ahmed

                
                
*/
