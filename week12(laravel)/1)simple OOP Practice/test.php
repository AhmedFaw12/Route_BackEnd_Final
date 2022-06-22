<?php

require_once("Model.php");
require_once("DB.php");
require_once("Category.php");

echo "<pre>";
$cat = new Category();

// $obj = DB::create($cat, ["id"=>500, "name"=>"xxx"]);

// $obj = DB::find("categories", "Category", 199);
$rslt = DB::getAll("categories", "category");

//deleting all records 
foreach($rslt as $cat){
    DB::delete($cat);
}
// var_dump($rslt);
echo "</pre>";