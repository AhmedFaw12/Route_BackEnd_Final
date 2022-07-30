<?php

//paths and urls
define("PATH", __DIR__."/");
define("URL", "http://localhost/OOP_Workshop/techstore/");

define("APATH", __DIR__."/admin/");
define("AURL", "http://localhost/OOP_Workshop/techstore/admin/");

//db credentials
define("DB_SERVERNAME", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "techstore");
define("DB_PORT", 3306);


//include classes
require_once(PATH."vendor/autoload.php");


//objects
use TechStore\Classes\Request;
use TechStore\Classes\Session;


$request = new Request();
$session = new Session();


