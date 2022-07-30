<?php  

/*
Add To Cart:
    Intro:
        -we want to add products to a cart
        -these products are stored in session
        -when user go to cart.php page , we will display his chosen products and get the summation of prices(total payment)

        -we will store in session(cart session variable):
        -id,qty of products , and when we go to cart page , get products data(name, price, img) from database

        or

        -when we store in cart session from the beginning (store id, qty , all product data ), when we go to cart.php , display them 

        -we will use 2nd method


        Example for cart session:
            -cart array contain array of products
            -we will make key of inner arrays is product's id
            'cart' =>[
                '3' => [
                    'qty' =>1,
                    'name' =>'',
                    'price' =>'',
                    'img' =>'',
                ],

                '5' => [
                    'qty' =>3,
                    'name' =>'',
                    'price' =>'',
                    'img' =>'',
                ]
            ]    
        -Conclusion :
            -we will store data of chosen product in session(cart) 
            -we will use a form ,when submitted , it will go to add-cart.php handler , which will store data in session and then redirect 
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Example:
        classes/Cart.php:
            //code
            <?php  

            namespace TechStore\Classes;

            class Cart{
                public function add(string $id, array $prodData){
                    $_SESSION["cart"][$id] = $prodData;
                }

                public function count(){
                    $count = 0;
                    foreach($_SESSION["cart"] as $prodData){
                        $count += $prodData["qty"];
                    }
                    // return count($_SESSION['cart']);
                    return $count;   
                }

                public function total(){
                    $total = 0;
                    foreach($_SESSION["cart"] as $prodData){
                        $total += $prodData["qty"] * $prodData["price"];
                    }

                    return $total;
                }

                public function has(string $id) : bool{
                    return array_key_exists($id, $_SESSION["cart"]);
                }
            }
            ?>
            -we will a class for Cart (to add to/remove from/edit/count/get total_price cart )

            -we made a class for cart although we made a class for session
            -this is because session class we made is very simple(to set/get error messages, store id of admin who logins)
            -but cart class will be more complex 
            
            -add function:
                -we will made a function to add to cart that takes id of product and product data
                -id is string as it is coming from form (even if it is a number)
                -id will be the key of product data

                -we didn't make session start , because we will require app.php in add-cart.php
                -in app.php ,we already made an object from session class (which has started session in construct)

            -count function:
                -we want to get the number of items added to cart
                -we used foreach to get qty of every product added to cart
            
            -total function:
                -we want to get the price of items added to cart
                -we used foreach to get (qty of every product added to cart * price of each product) and added to the total
            
            -has function:
                -we want to check if certain product added to the session cart array , in order not to add it again to the cart 
                -also to hide submit button when user try to add product again to the cart
                -we used array_key_exists($key, $array):
                    -check if given key exists in array
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        classes/Request.php:
            public function redirect($path){
                header("location: ". URL .$path);
            }

            -we made a function to redirect to certain url using header function
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        handlers/add-cart.php:
            <?php  

            require_once("../app.php");

            use TechStore\Classes\Cart;

            if($request->postHas("submit")){
                $id = $request->post("id");
                $qty = $request->post("qty");
                $name = $request->post("name");
                $price = $request->post("price");
                $img = $request->post("img");
            
                $prodData = [
                    "qty" => $qty,
                    "name" => $name,
                    "price" => $price,
                    "img" => $img,
                ];

                $cart = new Cart;
                $cart->add($id, $prodData);

                $request->redirect("products.php");

            }
            
            -it will require app.php(inorder to use request object, cart class)
            -the (products, product, search, category) required header(which required app.php) , put add-cart.php don't have header so we required app.php

            -we received product data ,and added it to array
            -we made object of cart class, and addded prodData to cart

            -then we redirected to products.php

        ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        product.php:
            <form method="POST" action="<?=URL;?>handlers/add-cart.php">
                <div class="clearfix" style="z-index: 1000;">
                    
                    <input type="hidden" name="id" value="<?=$prod["prodId"]?>">
                    <input type="hidden" name="name" value="<?=$prod["prodName"]?>">
                    <input type="hidden" name="price" value="<?=$prod["price"]?>">
                    <input type="hidden" name="img" value="<?=$prod["img"]?>">
                    <!-- Product Quantity -->
                    <div class="product_quantity clearfix">
                        <span>Quantity: </span>
                        <input id="quantity_input" type="text" name="qty" pattern="[0-9]*" value="1">
                        <div class="quantity_buttons">
                            <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                            <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                        </div>
                    </div>

                    <div class="product_price">$<?= $prod["price"] ?></div>

                </div>
                <?php if(! $cart->has($prod["prodId"])): ?>
                    <div class="button_container">
                        <button type="submit" name="submit" class="button cart_button">Add to Cart</button>
                    </div>
                <?php endif; ?>
            </form>
            
            -we made a form to send product data to add-cart.php handler
            -we made input for qty of required product, also we made hidden inputs for product data(id, name, price, img)

            -we made sure that if product already added to cart , then don't show submit button
            -we didn't make object from cart class and used the cart object already made in header.php
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        inc/header.php:
            use TechStore\Classes\Cart;
        
            $cart = new Cart;
            $cartCount = $cart->count();
            $cartTotal = $cart->total();

        
             <!-- Wishlist -->
            <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                    <!-- Cart -->
                    <div class="cart">
                        <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                            <div class="cart_icon">
                                <img src="<?=URL;?>assets/images/cart.png" alt="">
                                <div class="cart_count"><span><?= $cartCount ?></span></div>
                            </div>
                            <div class="cart_content">
                                <div class="cart_text"><a href="#">Cart</a></div>
                                <div class="cart_price">$<?= $cartTotal ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            -we made object from Cart and get the total price and count of items in the cart 
            -we displayed a cart icon with count and total price of items in the cart
*/
?>