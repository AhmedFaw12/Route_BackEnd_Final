<?php

use TechStore\Classes\Models\Order;

require_once("../../app.php");

if($request->getHas("id")){
    $id = $request->get("id");

    $ord = new Order;
    $ord->update("status ='approved'", $id);

    $session->set("success", "order approved");
    $request->aredirect("order.php?id=$id");
}else{
    $request->aredirect("orders.php");
}

?>