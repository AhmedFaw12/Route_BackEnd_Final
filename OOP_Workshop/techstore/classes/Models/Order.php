<?php

namespace TechStore\Classes\Models;
use TechStore\Classes\Db;

class Order extends Db
{
    public function __construct(){
        $this->table = "orders";
        $this->connect(); 
    }

    
}

