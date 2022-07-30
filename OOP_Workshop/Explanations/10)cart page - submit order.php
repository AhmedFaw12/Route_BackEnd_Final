<?php  
/*
Display Cart items:
    header.php:
        <div class="cart_text"><a href="<?=URL;?>cart.php">Cart</a></div>

        <li><a href="<?=URL;?>cart.php">Cart<i class="fas fa-chevron-down"></i></a></li>

        -we adjusted links in header.php to go to cart.php page
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    classes/Cart.php:
        public function all(){
            return $_SESSION["cart"];
        }
        -we made a function to return all cart items
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    cart.php:
        <div class="cart_items">
            <ul class="cart_list">
                <?php  
                $index = 0;
                ?>
                <?php foreach($cart->all() as $id => $prodData): ?>
                    <li class="cart_item clearfix">
                        <div class="cart_item_image"><img src="<?=URL;?>uploads/<?=$prodData["img"];?>" alt=""></div>
                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                            <div class="cart_item_name cart_info_col">
                                <?php if($index == 0): ?>
                                    <div class="cart_item_title">Name</div>
                                <?php endif; ?>
                                <div class="cart_item_text"><?=$prodData["name"];?></div>
                            </div>
                            <div class="cart_item_quantity cart_info_col">
                                <?php if($index == 0): ?>
                                    <div class="cart_item_title">Quantity</div>
                                <?php endif; ?>
                                <div class="cart_item_text"><?=$prodData["qty"];?></div>
                            </div>
                            <div class="cart_item_price cart_info_col">
                                <?php if($index == 0): ?>
                                    <div class="cart_item_title">Price</div>
                                <?php endif; ?>
                                <div class="cart_item_text">$<?=$prodData["price"];?></div>
                            </div>
                            <div class="cart_item_total cart_info_col">
                                <?php if($index == 0): ?>
                                    <div class="cart_item_title">Total</div>
                                <?php endif; ?>
                                <div class="cart_item_text">$<?=$prodData["price"] * $prodData["qty"];?></div>
                            </div>
                            <div class="cart_item_action cart_info_col">
                                <?php if($index == 0): ?>
                                    <div class="cart_item_title">Remove</div>
                                <?php endif; ?>
                                <div class="cart_item_text">
                                    <a href="<?=URL. "handlers/remove-cart.php?id=". $id;?>">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php  
                    $index++;
                ?>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <!-- Order Total -->
        <div class="order_total">
            <div class="order_total_content text-md-right">
                <div class="order_total_title">Order Total:</div>
                <div class="order_total_amount">$<?=$cartTotal;?></div>
            </div>
        </div>

        -we displayed cart items data using foreach
        -we displayed headers/titles(name, quantity, price, total price for this product, remove ) only one time using index variable
        -headers/titles will be displayed if index === 0;
        -we displayed remove icon for each product , which will redirect to remove-cart.php page

        -we also displayed total price of order
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Remove Product from Cart:
    cart.php:
        <a href="<?=URL. "handlers/remove-cart.php?id=". $id;?>">
            <i class="fas fa-trash"></i>
        </a>

        -we made a link to delete/remove product from cart
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    classes/Cart.php:
        public function remove($id){
            unset($_SESSION["cart"][$id]);
        }
        
        -we made a function to remove element/item/product from session using id
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    handlers/remove-cart.php:
        <?php

        require("../app.php");

        use TechStore\Classes\Cart;

        if($request->getHas('id')){
            $id = $request->get("id");
        }

        $cart = new Cart;
        $cart->remove($id);

        $request->redirect("cart.php");

        ?>

        -we will require app.php to use $request object and cart class
        -we will use Cart Class

        -we remove item from cart using id , then redirect to cart.php
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Add/submit Order:
    
    
    inc/messages.php:
        <?php  require_once("app.php")?>

        <?php if($session->has("errors")): ?>
            <div class="alert alert-danger">
                <?php foreach($session->get("errors") as $error): ?>
                    <p class="mb-0"><?= $error ?></p>
                <?php endforeach; $session->remove("errors");?>
            </div>
        <?php endif; ?>

        <?php if($session->has("success")): ?>
            <div class="alert alert-success">
                <p class="mb-0"><?= $session->get("success") ?></p>
            </div>
        <?php endif; $session->remove("success");?>

        -we display errors messages and success message from session
        -after displaying messages ,remove them from session ,so they won't be displayed again when we refresh page , and not to be added to the future messages

    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    cart.php:
        <?php include(PATH."inc/messages.php") ?>

        <form method="POST" action="<?=URL;?>handlers/add-order.php" id="order_form">
            <div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
                <input type="text" name="name" id="contact_form_name" class="contact_form_name input_field"  placeholder="Your name">
                <input type="email" name="email" id="contact_form_email" class="contact_form_email input_field" placeholder="Your email">
                <input type="text" name="phone" id="contact_form_phone" class="contact_form_phone input_field" placeholder="Your phone number">
            </div>
            <div class="contact_form_text">
                <textarea id="contact_form_message" name="address" class="text_field contact_form_message" rows="4" placeholder="Your address"></textarea>
            </div>
            <div class="contact_form_button">
                <button type="submit" name="submit" class="button contact_submit_button">Submit Order</button>
            </div>
        </form>

        -we made a post form to submit our order
        -inputs are name, email, phone ,address
        -name,phone are required
        -the form will go to add-order.php page

        -errors will be displayed incase of validation errors , so we included messages.php
    
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    classes/Cart.php:
        public function empty(){
            $_SESSION["cart"] = [];
        }

        -we made a method to empty cart
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    classes/Validation/Validator.php:
        public function validate(string $name, $value, array $rules):void{
            foreach ($rules as $rule) {
                $className = "TechStore\\Classes\\Validation\\" . $rule;
                $obj = new $className;

                $error = $obj->check($name, $value);
                if($error !== false){
                    $this->errors[] = $error;
                    break;
                }
            }
        }

        -when we make object from class dynamically(class name comes from variable) ,we must write its namespace with it:
            $className = "TechStore\\Classes\\Validation\\" . $rule;
            $obj = new $className;

            -don't forget to make double backslashes (\\)

    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    classes/Db.php:
        public function insert(string $fields, string $values):bool
        {
            $sql = "INSERT INTO $this->table ($fields) VALUES($values)";

            return mysqli_query($this->conn, $sql);
        }
        public function insertAndGetId(string $fields, string $values)
        {
            $sql = "INSERT INTO $this->table ($fields) VALUES($values)";

            mysqli_query($this->conn, $sql);

            return mysqli_insert_id($this->conn);
        }

        insertAndGetId():
            -we made a function to insert a record into table and return the id added
        mysqli_insert_id($this->conn):
            Returns the value generated for an AUTO_INCREMENT column by the last query   

    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    handlers/add-order.php:
        <?php  
        require("../app.php");

        use TechStore\Classes\Cart;
        use TechStore\Classes\Models\Order;
        use TechStore\Classes\Models\OrderDetail;
        use TechStore\Classes\Validation\Validator;

        $cart = new Cart;

        if($request->postHas('submit') && $cart->count() !== 0){
            $name = $request->post("name");
            $email = $request->post("email");
            $phone = $request->post("phone");
            $address = $request->post("address");
        
            //validation
            $validator = new Validator;
            $validator->validate("name", $name, ["required", "str", "max"]);
            if(!empty($email)){
                $validator->validate("email", $email, ["email", "max"]);
                $email = "'$email'";
            }else{
                $email = "NULL";
            }
            $validator->validate("phone", $phone, ["required", "str", "max"]);
            if(!empty($address)){
                $validator->validate("address", $address, ["str", "max"]);
                $address = "'$address'";      
            }else{
                $address = "NULL";
            }

            if($validator->hasErrors()){
                $session->set("errors", $validator->getErrors());
                $request->redirect("cart.php");
            }else{
                $order = new Order;
                $orderDetail = new OrderDetail;
                $orderId = $order->insertAndGetId("name, email, phone, address", "'$name', $email, '$phone', $address"); 
                
                foreach($cart->all() as $prodId =>$prodData){
                    $qty = $prodData["qty"];
                    $orderDetail->insert("order_id, product_id, qty", "$orderId, $prodId, $qty");
                }
                
                $session->set("success", "Order Added Successfully");
                $cart->empty();
                $request->redirect("products.php");
            }

        }else{
            $session->set("errors", ["There is no Cart"]);  
            $request->redirect("products.php");
        }

        ?>

        -we required app.php to use request , cart, order, orderDetail
        -we will check if user pressed submit button and there was no cart
        -if there was no cart , then don't validate inputs or add order , and set error message in session , then reidrect to products.php to display error message


        -if there was cart, then validate inputs 
        -we validated name, email, phone ,address using validator class we made
        -we sent our rules of validation to validate method

        -email, address are not required, so we will  validate them only when they are not empty

        -if there are errors in validation, save errors in session , then redirect back to cart.php to display errorss

        -if there are no errors , then client/user data in orders table and get order_id
        -then we add each product in the cart to order_details table using foreach
        -then empty the cart
        -save success message in session
        -then redirect to products.php to display success message


        Note:
            $orderId = $order->insertAndGetId("name, email, phone, address", "'$name', $email, '$phone', $address"); 

            -since email, address are not required , we want to set them with null in orders table or they will be set with empty strings


            -so we will check if email or address or both are empty , then make:
                $address = "NULL";
                $email = "NULL";
                
                -and write their column names in insert method without single quotes

            -if email or address are not empty, then make:
                -we will add the single quotes to $email string, inorder to be stored in orders table
                -because in previous step ,we wrote their column names in insert method without single quotes

                $email = "'$email'";
                $address = "'$address'";

    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    products.php:
        <?php include(PATH."inc/messages.php") ?>

        -we displayed success message incase of success added order

*/

?>