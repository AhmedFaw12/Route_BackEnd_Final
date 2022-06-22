<?php
abstract class User{
        // global area 
        //properties - fields -class members - instance variables

        //access modifer $var_name;
        // encapsulation (hide members and getter setter)
        var $name;   // public 
        public $email;
        private $id =500;
        protected $pw ="123";

        function __construct()
        {
            echo "<br>User Created <br>";
        }
        
        function login(){

        }

        function register(){

        }

        function profile(){
            return "Id: " .$this->id."<br>Name : " . $this->name . "<br>Email : " . $this->email;
        }
        
        // getter
        function getId(){
            return $this->id;
        }

        // setter
        function setPW($old_pw , $new_pw){
            if($this->pw == $old_pw){
                $this->pw =$new_pw;
                return true;
            }
            return false;
        }
		
		
    }