<?php
    class Category extends Model{
        public $name;
        
        public function __construct(){
            $this->class_name = "Category";
            $this->table_name = "categories";
            $this->columns = ["id", "name"];
        }
        
        public function fill($values){
            $this->id = $values["id"];
            $this->name = $values["name"];   
        }
    }