<?php

require_once("Category.php");
class Product extends Model{
    public $name, $price;
    public Category $category;

    public function __construct(){
        $this->class_name = "Product";
        $this->table_name = "products";
        $this->columns = ["id",  "name",  "price",  "category_id"];
    }

    public function fill($values){
        $this->id = $values["id"];
        $this->name = $values["name"];
        $this->price =$values["price"];
        $this->category = $values["category"];
    }
}