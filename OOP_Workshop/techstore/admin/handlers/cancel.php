<?php

use TechStore\Classes\Models\Order;

require_once("../../app.php");

if($request->getHas("id")){
    $id = $request->get("id");

    $ord = new Order;
    $ord->update("status ='canceled'", $id);

    $session->set("success", "order canceled");
    $request->aredirect("order.php?id=$id");
}else{
    $request->aredirect("orders.php");
}

?>