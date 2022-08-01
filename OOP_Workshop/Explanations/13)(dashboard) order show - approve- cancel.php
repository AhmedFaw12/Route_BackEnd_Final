<?php  

/*
Dashboard (Orders show -approve - cancel):
    Display orders:
        classes/models/Order.php:
            public function selectAll(string $fields = "*") : array
            {
                $sql = "SELECT $fields FROM $this->table JOIN order_details JOIN products 
                ON $this->table.id = order_details.order_id
                AND products.id = order_details.product_id
                GROUP BY $this->table.id;";

                $result = mysqli_query($this->conn, $sql);

                return mysqli_fetch_all($result, MYSQLI_ASSOC);
            }

            -we want to display name, phone, created_at, status from orders table , and
            we want to display total price(which comes from qty from order_details table and price for each product from products) for each order(group by orders.id)

        admin/orders.php:
            <?php  
            use TechStore\Classes\Models\Order;

            $ord = new Order;
            $orders = $ord->selectAll("orders.id, orders.name, orders.phone, orders.status, orders.created_at, SUM(qty*price) AS total");

            ?>
            <?php foreach($orders as $index=>$order): ?>
                        
            <tr>
                <th scope="row"><?= $index+1 ?></th>
                <td><?= $order["name"] ?></td>
                <td><?= $order["phone"] ?></td>
                <td>$<?= $order["total"] ?></td>
                <td><?= date("d M,Y  h:i a", strtotime($order["created_at"]))   ?></td>
                <td><?= $order["status"] ?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="<?=AURL . "order.php?id=" .$order["id"]?>">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>

            -we displayed orders data and total for each order using foreach
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    Display single order full data:
        classes/models/order.php:    
            public function selectId(int $id ,string $fields = "*")
            {
                $sql = "SELECT $fields FROM $this->table 
                JOIN order_details JOIN products 
                ON $this->table.id = order_details.order_id
                AND products.id = order_details.product_id
                WHERE $this->table.id = $id ";

                $result = mysqli_query($this->conn, $sql);

                return mysqli_fetch_assoc($result);
            }
            -we need to select certain order _id
            -we want to display name, phone, created_at, status from orders table , and
            we want to display total price(which comes from qty from order_details table and price for each product from products) for my order
            

        classes/models/OrderDetail.php:
            public function selectWithProducts($orderId) : array
            {
                $sql = "SELECT qty, name, price  FROM $this->table JOIN products 
                ON $this->table.product_id =products.id
                WHERE order_id = $orderId";

                $result = mysqli_query($this->conn, $sql);

                return mysqli_fetch_all($result, MYSQLI_ASSOC);
            }

            -we want to select orderdetails with product data for certain order_id
            -we will join between order_details and products
            -we made a new method for it
            -we didn't override selectAll:
                -because selectAll don't take id parameter , and don't take where condition
            -we didn't override selectId:
                -because selectId take id parameter as its primary key and we are not passing primary key
            -we didn't override selectWhere:
                -because selectWhere made for any where condition
                -not to override it and make specific to certain where condition every time we use it
            
            -we need this method to get orderDetail qty , product name, product price for each

            
        admin/order.php:
            <table class="table table-bordered">
                <thead>
                    <th colspan="2" class="text-center">Customer</th>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">Name</th>
                    <td><?=$order["name"] ?></td>
                    </tr>
                    <tr>
                    <th scope="row">Email</th>
                    <td><?=$order["email"] ?? "..." ?></td>
                    </tr>
                    <tr>
                    <th scope="row">Phone</th>
                    <td><?=$order["phone"] ?></td>
                    </tr>
                    <tr>
                    <th scope="row">Address</th>
                    <td><?= $order["address"] ?? "..." ?></td>
                    </tr>
                    <tr>
                    <th scope="row">Time</th>
                    <td><?=date("d M,Y h:i a",strtotime($order["created_at"])) ?></td>
                    </tr>
                    <tr>
                    <th scope="row">Status</th>
                    <td><?=$order["status"] ?></td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($details as $product): ?>
                    <tr>
                        <td><?= $product["name"] ?></td>
                        <td><?= $product["qty"] ?></td>
                        <td>$<?= $product["price"] ?></td>
                    </tr>
                    <?php endforeach; ?>
                    
                </tbody>
            </table>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Total</th>
                        <th>Change Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>$<?=$order["total"] ?></td>
                    <?php if($order["status"] == "pending"): ?>
                    
                        <td>
                            <a class="btn btn-success" href="<?=AURL ."handlers/approve.php?id=$id"?>">Approve</a>
                            <a class="btn btn-danger" href="<?=AURL ."handlers/cancel.php?id=$id"?>">Cancel</a>
                        </td>
                    <?php endif; ?>
                    </tr>
                </tbody>
            </table>

            -we displayed order data
            -we displayed orderDetails for the order using foreach
            -we displayed total price
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    -Approve - cancel order:
        admin/handlers/approve.php:
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
            -in approve ,we will just update status to approved

        admin/handlers/cancel.php:

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


*/

?>