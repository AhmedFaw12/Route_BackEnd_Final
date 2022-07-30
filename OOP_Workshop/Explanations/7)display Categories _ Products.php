<?php
/*
Display Categories:
    -we want to remove any dummy categories on our website and  display real categories from Database
    
    -categories exists in (sidebar in Header.php)
    -this is advantage :
        -we will get categories from database in header.php 
        -we don't need to get categories in any page
        -since all pages require header

    -categories also exists in category.php, products.php, search.php pages
     

    Example:
        inc/header.php:
            <?php
                use TechStore\Classes\Models\Cat;

                $c = new Cat;
                $cats = $c->selectAll("id, name"); 
            ?>

             <!-- Categories Menu -->

            <div class="cat_menu_container">
                <div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
                    <div class="cat_burger"><span></span><span></span><span></span></div>
                    <div class="cat_menu_text">categories</div>
                </div>

                <ul class="cat_menu">
                    <?php foreach ($cats as $cat) { ?>
                        
                        <li><a href="<?=URL?>category.php?id=<?= $cat['id'] ?>"><?=$cat['name'];?> <i class="fas fa-chevron-right ml-auto"></i></a></li>
                    <?php } ?>

                </ul>
            </div>

            -we selected all categories from database and displayed them using foreach

        category.php:
            <!-- Shop Sidebar -->
            <div class="shop_sidebar">
                <div class="sidebar_section">
                    <div class="sidebar_title">Categories</div>
                    <ul class="sidebar_categories">
                        <?php foreach ($cats as $cat): ?>
                            <li><a href="<?=URL?>category.php?id=<?= $cat['id'] ?>"><?=$cat['name'];?> </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>          
            </div>


            -since we already selected all categoreis in header.php, we don't need to select them in category.php

            -since header.php is included in category.php

            -we displayed all categories using foreach 

            -another way to write foreach :
                foreach(code):
                    //code
                endforeach;
        
        products.php:
            <!-- Shop Sidebar -->
            <div class="shop_sidebar">
                <div class="sidebar_section">
                    <div class="sidebar_title">Categories</div>
                    <ul class="sidebar_categories">
                        <?php foreach ($cats as $cat): ?>
                            <li><a href="<?=URL?>category.php?id=<?= $cat['id'] ?>"><?=$cat['name'];?> </a></li>
                        <?php endforeach; ?>
                        
                    </ul>
                </div>
                
            </div>
        
        search.php:
            <!-- Shop Sidebar -->
            <div class="shop_sidebar">
                <div class="sidebar_section">
                    <div class="sidebar_title">Categories</div>
                    <ul class="sidebar_categories">
                        <?php foreach ($cats as $cat): ?>
                            <li><a href="<?=URL?>category.php?id=<?= $cat['id'] ?>"><?=$cat['name'];?> </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>           
            </div>
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Display Single Category with all of its products:
    -we will select category by id , and get all of its data(including products)
    -we need to receive id sent by get request using request object we made
    

    Example:
        category.php:
            <?php

            include("inc/header.php")?>	

            <?php

            use TechStore\Classes\Models\Product;

            if($request->getHas("id")){
                $id = $request->get("id");
            }else{
                $id = 1; //we will put default value if user didn't send id
            }

            $category = $c->selectId($id);

            $pr = new Product;
            $prods = $pr->selectWhere("cat_id = $id", "id, name, img, price");

            ?>


            <?php if(!empty($category['name'])): ?>
				<h2 class="home_title"><?= $category['name'] ?></h2>
			<?php else: ?>
					<h2 class="home_title">No Category Found</h2>
			<?php endif; ?>


            <!-- Shop -->
            <?php if(!empty($category["name"])): ?>
                <div class="shop">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3">
            
                                <!-- Shop Sidebar -->
                                <div class="shop_sidebar">
                                    <div class="sidebar_section">
                                        <div class="sidebar_title">Categories</div>
                                        <ul class="sidebar_categories">
                                            <?php foreach ($cats as $cat): ?>
                                                <li><a href="<?=URL?>category.php?id=<?= $cat['id'] ?>"><?=$cat['name'];?> </a></li>
                                            <?php endforeach; ?>
                                            
                                        </ul>
                                    </div>
                                    
                                </div>
            
                            </div>
            
                            <div class="col-lg-9">
                                
                                <!-- Shop Content -->
            
                                <div class="shop_content">
                                    <!-- all products for single category -->
                                    <div class="product_grid">
                                        <div class="product_grid_border"></div>
                                        <?php foreach ($prods as $prod): ?>
                                            <!-- Product Item -->							
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="<?=URL . "uploads/" . $prod["img"];?>" alt="<?=$prod["name"]?> img"></div>
                                                <div class="product_content pt-3">
                                                    <div class="product_price m-auto">$<?= $prod['price']?></div>
                                                    <div class="product_name"><div><a href="<?=URL . "product.php?id=" . $prod["id"];?>" tabindex="0"><?=$prod["name"]?></a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>	
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- Shop Page Navigation -->
            
                                    <div class="shop_page_nav d-flex flex-row">
                                        <div class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div>
                                        <ul class="page_nav d-flex flex-row">
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">...</a></li>
                                            <li><a href="#">21</a></li>
                                        </ul>
                                        <div class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div>
                                    </div>
            
                                </div>
            
            
            
                            </div>
                        </div>
                    </div>
                </div>	
            <?php else: ?>
                <!-- empty shop -->
                <div class = "shop"></div>
            <?php endif; ?>

            Explanations:
                -first we selected category by id sent by get request using request object
                -we checked that if id is not set(not send), we will set it to (id = 1) by default
                -we selected all product for this category id
                
                -we displayed category name
                -we will check on category id , if category id not exists , we will display instead (no category found)

                -we displayed all products(name, img, price) using foreach
                -we will check on category id , if category id not exists , we will display empty div instead of products
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Display all products:
    Example:
        products.php:
            <?php
                use TechStore\Classes\Models\Product;

                $pr = new Product;
                $prods = $pr->selectAll("id, name, price, img");
                
            ?>

            <!-- Shop Content -->

            <div class="shop_content">

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

                <!-- Shop Page Navigation -->

                <div class="shop_page_nav d-flex flex-row">
                    <div class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div>
                    <ul class="page_nav d-flex flex-row">
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">...</a></li>
                        <li><a href="#">21</a></li>
                    </ul>
                    <div class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div>
                </div>

            </div>

            -we selected all products
            -we displayed them using foreach
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Display Single Product by Id:
    product.php:
        <?php include("inc/header.php")?>
        <?php
            use TechStore\Classes\Models\Product;

            if($request->getHas("id")){
                $id = $request->get("id");
            }else{
                $id = 1; //we will put default value if user didn't send id
            }


            $pr = new Product;
            $prod = $pr->selectId($id, "products.id AS prodId, products.name AS prodName, `desc`, price, img, cats.name AS catName");

        ?>

            <?php if(!empty($prod)): ?>
                <!-- Single Product -->
                <div class="single_product">
                    <div class="container">
                        <div class="row">
                            <!-- Selected Image -->
                            <div class="col-lg-6 order-lg-2 order-1">
                                <div class="image_selected"><img src="<?=URL."uploads/".$prod["img"]?>" alt="prod_img"></div>
                            </div>
            
                            <!-- Description -->
                            <div class="col-lg-6 order-3">
                                <div class="product_description">
                                    <div class="product_category"><?= $prod["catName"] ?></div>
                                    <div class="product_name"><?= $prod["prodName"] ?></div>
                                    <div class="product_text"><p><?= $prod["desc"] ?></p></div>
                                    <div class="order_info d-flex flex-row">
                                        <form action="#">
                                            <div class="clearfix" style="z-index: 1000;">
            
                                                <!-- Product Quantity -->
                                                <div class="product_quantity clearfix">
                                                    <span>Quantity: </span>
                                                    <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                                    <div class="quantity_buttons">
                                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                                                    </div>
                                                </div>
            
                                                <div class="product_price">$<?= $prod["price"] ?></div>
            
                                            </div>
            
                                            <div class="button_container">
                                                <button type="button" class="button cart_button">Add to Cart</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
            
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="single_product text-center" style="height : 500px">
                    <h2>No Data Found</h2>
                </div>
            <?php endif; ?>

        <?php include("inc/footer.php")?>
        
        -we selected product by id sent by get request using request object
        -we want to select category name with product(that we selected)
        -hence, we will override selectId method in Product model class that inherits from Db class

        -we want to select from more that one table , so we will use join

        -we will give aliases for the columns that we select , because some column names in both tables are the same

            
        -display product data
        -check if user send id not exists , then we will display empty div with (No Data Found) instead of product data
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    classes/models/Product.php:
        public function selectId(int $id ,string $fields = "products.*")
        {
            $sql = "SELECT $fields FROM $this->table JOIN cats 
            ON $this->table.cat_id = cats.id 
            WHERE $this->table.id = $id";

            $result = mysqli_query($this->conn, $sql);

            return mysqli_fetch_assoc($result);
        }

        -we want to select category name with product(that we selected)
        -hence, we will override selectId method in Product model class that inherits from Db class

        -we want to select from more that one table , so we will use join

        -we will give aliases for the columns that we select , because some column names in both tables are the same


*/