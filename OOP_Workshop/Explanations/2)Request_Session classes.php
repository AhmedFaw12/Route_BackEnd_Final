<?php
/*
Intro:
    -we will make our classes
    -these classes(Request, Session, Db_models, Validate) are general classes  that are not related to a certain project
    -these classes can be used in many projects and can be enhanced
    -this will reduce work time later
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Request Class:
    -we deal with requests (get or put) through superGlobals (_GET, _POST)
    -so we will make class , so that we will not use these superglobals later

    Example:
        classes/Request.php:
            class Request{
                public function get(string $key)
                {
                    return $_GET[$key];
                }
                public function post(string $key)
                {
                    return $_POST[$key];
                }

                public function getHas(string $key):bool
                {
                    return isset($_GET[$key]); //return true or false 
                }
                public function postHas(string $key) :bool 
                {
                    return isset($_POST[$key]); //return true or false 
                }

                public function postClean(string $key) :bool 
                {
                    return trim(htmlspecialchars($_POST[$key]));
                }
            }

            in postHas($key), getHas($key):
                -if we didn't write name in url , warning error undefined index appear
                -so we want to make method to check if $key exists in superglobals or not
                -we will use isset
                -we will return true or false
            
            -postClean($key):
                -we will get value of $_POST[$key] after cleaning it , to protect my website from any attacks

                -we will use trim() , htmlspecialchars()
                
                -htmlspecialchars(string):string :
                    -stops html tags from working and return/print them as they are in the output string
                
                -trim(string, charlist(optional)):string(return type):
                    removes whitespaces and other predefined characters from both sides(begin , end) of a string

                -we didn't make getClean(), because we won't need it.
                -because mostly things needed to be cleaned , are the things that will be stored in database 
                
                -and things needed to be stored in database are sent using form with method post

            type hinting:
                -To enforce the types for function parameters and return value, you can use type hints.
                
                -postClean(string $key), post(string $key), get(string $key), getHas(string $key), getPost(string $key)

                -getHas(string $key):bool, getPost(string $key):bool
                -  :bool means it will return bool
            
            

    
        
    -to test request class:
        test.php:
            require_once("classes/Request.php");

            $request = new Request();

            echo $request->get('name');
        
        -to test get :
            write in url:http://localhost/OOP Workshop/techstore/test.php?name=ahmed

            $request = new Request();
            echo $request->get('name');

            -if we didn't write name in url , warning error undefined index appear

            -so we made postHas(), getHas()
    
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Session Class:
    -it will deal with $_SESSION superglobal

    -we need to add something to session, read something from session, check if the key exists in session or not(isset()), remove from session, terminate session

    Example:
        classes/Session.php:
            class Session{
                public function __construct(){
                    if(session_status() == PHP_SESSION_NONE){
                        session_start();
                    }
                }

                public function set(string $key, $value){
                    $_SESSION[$key] = $value;
                }

                public function get(string $key){
                    return $_SESSION[$key];
                }

                public function has(string $key) : bool {
                    return isset($_SESSION[$key]); 
                }

                public function remove(string $key){
                    unset($_SESSION[$key]);
                }

                public function destroy(){
                    $_SESSION = [];
                    session_destroy();
                }
            }
            
            -set() to set value in session
            -set(string $key, $value):
                key is string
                -value can be number, string, array ,so we will not determine type
                -in php8 ,we can determine multiple datatypes for a variable or function return : string | int | array |float | null | bool $value

                -we will not use it in this workshop


            -get() to get value/element from session
            get(string $key) : $key is string

            -has(string $key) : bool 
                -to check if session has key or not
                -returns bool
                -key is string

            -remove(string $key) 
                -remove element from session
            
            -destroy() :
                -we destroy session
                -we can empty SESSION ($_SESSION = [])superglobal before destroying session
                -because sometimes racing happens
                -racing:
                    -while making destroying session, script wasn't finished
                    -session values remains in session superglobals until script ends, evenif we used session destroy
                    
                    -so we empty session before destroying it
            
            -we want to make sure that we will not use any of these session method before we start session ,to use session class we need to make object, so we start session in constructor:
                public function __construct(){
                    if(session_status() == PHP_SESSION_NONE){
                        session_start();
                    }
                }

            -session_start() can make problems:
                -we must make sure that session_start() is written in the top of script
                and make sure that no (html / php echo in php tags) is written before it 

                -this thing happens also with setcookie(), header()

                -we will solve this while making scripts

                -second problem(pb): 
                    -we can making multiple object from session class by mistake
                    -so session_start will be written multiple times

                    -so to make sure session_start() is not written multiple times before
                    -we will make if condition using session_status()
                    if(session_status() == PHP_SESSION_NONE){
                        session_start();
                    }

                    -if we already started session, don't start it again
    ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    Testing session:
        test.php:
            require_once("classes/Session.php");
            
            $sess = new Session();
            
            $sess->set('name', 'ahmed');
            echo $sess->get('name');

            echo $sess->has('name');

            echo '<pre>';
            print_r($_SESSION);
            echo '</pre>';

            $sess->remove('name');
            var_dump($sess->has('name')) ; //false

            echo '<pre>';
            print_r($_SESSION);
            echo '</pre>';

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Various Functions:
    -htmlspecialchars(string):string :
        -stops html tags from working and return/print them as they are in the output string
    
    -trim(string, charlist(optional)):string(return type):
        removes whitespaces and other predefined characters from both sides(begin , end) of a string

        paramters:
        charlist(optional): to determine which characters to remove:
        - \t -> tab
        - \n -> newline
        - " " -> white space(default)
        -\0 -> null
*/
