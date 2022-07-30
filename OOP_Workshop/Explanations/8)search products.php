<?php  
/*
Search Products:
    -we want to search for productss
    -search bar is in the header.php page which will be displayed in all pages

    -search bar is an input inside form with get Method
    -when we press on submit button(Magnifier lens icon), it will go to search.php

    -we will not use the dropdown in the search bar , but we can't remove it
    -when we remove it , the design will be corrupted

    Example:
        inc/header.php:
             <!-- Search -->
            <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                <div class="header_search">
                    <div class="header_search_content">
                        <div class="header_search_form_container">
                            <form method="GET" action="<?=URL."search.php"?>" class="header_search_form clearfix">
                                <input type="search" required="required" name = "keyword" class="header_search_input" placeholder="Search for products...">
                                <div class="custom_dropdown">
                                    <div class="custom_dropdown_list">
                                        <span class="custom_dropdown_placeholder clc">All Categories</span>
                                        <i class="fas fa-chevron-down"></i>
                                        <ul class="custom_list clc">
                                            <li><a class="clc" href="#">All Categories</a></li>
                                            <li><a class="clc" href="#">Computers</a></li>
                                            <li><a class="clc" href="#">Laptops</a></li>
                                            <li><a class="clc" href="#">Cameras</a></li>
                                            <li><a class="clc" href="#">Hardware</a></li>
                                            <li><a class="clc" href="#">Smartphones</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <button type="submit" class="header_search_button trans_300" value="Submit"><img src="<?=URL;?>assets/images/search.png" alt=""></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            -search bar is an input inside form with get Method
            -when we press on submit button(Magnifier lens icon), it will go to search.php

            -we will not use the dropdown in the search bar , but we can't remove it
            -when we remove it , the design will be corrupted

        search.php:
            <?php  
                use TechStore\Classes\Models\Product;

                if($request->getHas("keyword")){
                    $keyword = $request->get("keyword");
                }else{
                    $keyword = "";
                }

                $pr = new Product;
                $prods = $pr->selectWhere("name LIKE '%$keyword%'", "id, name, price, img");
            ?>

            <h2 class="home_title">Search results for: <?= $keyword ?></h2>

            <div class="product_grid">
                <div class="product_grid_border"></div>

                <?php foreach($prods as $prod): ?>
                    <!-- Product Item -->
                    <div class="product_item">
                        <div class="product_border"></div>
                        <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="<?=URL."uploads/". $prod["img"]?>" alt=""></div>
                        <div class="product_content pt-3">
                            <div class="product_price m-auto">$<?= $prod["price"] ?></div>
                            <div class="product_name"><div><a href="<?=URL ."product.php?id=" . $prod['id']?>" tabindex="0"><?=$prod["name"] ?></a></div></div>
                        </div>
                        <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                    </div>
                <?php endforeach; ?>
                
            </div>

            -we will select all products using LIKE to search for the products
            -display products from search results using foreach
*/
?>