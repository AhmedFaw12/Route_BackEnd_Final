<?php   
    require_once("User.php");

  
    class Customer extends User {

        public $education ,$address;

        function __construct()
        {
            parent::__construct();
            echo "<br>Customer Created<br>";
        }

    }