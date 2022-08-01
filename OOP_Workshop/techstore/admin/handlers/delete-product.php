<?php

use TechStore\Classes\Models\Product;

require_once("../../app.php");

if($request->getHas("id")){
    $id = $request->get("id");
    
    $pr = new Product;
    $prod = $pr->selectId($id, "img");

    if(isset($prod)){
        //delete image from database
        $imgName = $prod["img"];
        unlink(PATH."uploads/$imgName");

        //delete product from database
        $pr->delete($id);
        $session->set("success", "product deleted successfully");
        $request->aredirect("products.php");

    }else{
        $session->set("errors", ["Image not Found"]);
        $request->aredirect("products.php");
    }

}else{
    $session->set("errors", ["please select product to be deleted"]);
    $request->aredirect("products.php");
}

?>