<?php
/*
Website theme:
    Intro:
        -for our website we will use theme called (onetech) from (Colorlib) website
        -we will copy files from designs/techstore folder into our project
        -convert .html into .php 

        -css links ,nav bar ,footer, js scripts are common in  many pages ,so we will take them and put them in a 2pages  and include them in our pages

        -css links ,nav bar will be put in (inc/header.php),
        -footer, js scripts will be put in (inc/footer.php),

        -we will collect theme images, js, plugins , styles(change its name to css) in one folder called assets and then change the links paths

        -some images are for uploads(dynamic) so we will put them in separate folder called uploads and other images are static so we will keep them in assets/images 
        -adjust the links after moving dynamic images(products images)
        -we adjusted links in products, category, search pages
        -also the image in product page is dynamic , we will get if from uploads folder

--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

App file:
    -Instead of including classes in every page, add database credentials(db name, username, ....) manually
    -we will make app.php
    -app file : we will put every thing we require and needed 
    -this app file will be included in all website pages(website main theme, admin/dashboard theme)

    -Steps:
        -adjust paths and urls
        -database credentials
        -include classes
        -objects(request, session, ...)
        
    -Paths & urls:
        Paths:
            -all our job was working with relative path(not full paths)
            -it is better to work with absolute(full path from very beginning, from the root) paths
            -C:/xampp/htdocs/techstore/...

            -but (C:/xampp/htdocs/techstore/) has a problem is that when moving project from place to place/server, then i have to change this path every time 

            -we can get path in a dynamic way using (__DIR__) constant 
            -  __DIR__ will get me full path untill my working directory :
                Example:
                    C:\xampp\htdocs\techstore

                    -but __DIR__ don't get me the last / , so we will put it ourselves:
                        $path = __DIR__."/";

                -backslashes(\) won't make problems with frontSlashes(/)
            -so this code will work on windows or linux

            -$path = __DIR__."/";   :
                -$path is a variable ,so anyone can change it, so we will make it const
                -define("PATH", __DIR__."/");


            -we will use path in includes (include, include_one, require, require_once)

        URL:
            define("URL", "http://localhost/OOP_Workshop/techstore/");
            
            -urls is used in :
                -anchor tags(href = "") , links(css,js,imgs)
                -header("") 
                

        -include app.php in header.php, footer.php and adjust links
        -header and footer are seen/used in website pages

        -in footer and header we say require_once("app.php") and not require_once("../app.php")

        -because header and footer are included in index, products, product, category, search pages, so header and footer are executed inside these pages and these pages are next to app file , so we just say require_once("app.php")


        Example:
            app.php:
                //paths and urls
                define("PATH", __DIR__."/");
                define("URL", "http://localhost/OOP_Workshop/techstore/");
            ----------------------------------------------------------------------------------------------------------------------------------------------------------------
            inc/header.php:
                <?php require_once("app.php");?>

                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <title>TechStore</title>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="description" content="TechStore">
                    <meta name="viewport" content="width=device-width, initial-scale=1">

                    <link rel="stylesheet" type="text/css" href="<?=URL?>assets/css/bootstrap4/bootstrap.min.css">
                    <link href="<?=URL?>assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
                    <link rel="stylesheet" type="text/css" href="<?=URL?>assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
                    <link rel="stylesheet" type="text/css" href="<?=URL?>assets/plugins/slick-1.8.0/slick.css">
                    <link rel="stylesheet" type="text/css" href="<?=URL?>assets/css/main_styles.css">
                    <link rel="stylesheet" type="text/css" href="<?=URL?>assets/css/responsive.css">
                    <link rel="stylesheet" type="text/css" href="<?=URL?>assets/css/shop_styles.css">
                    <link rel="stylesheet" type="text/css" href="<?=URL?>assets/css/shop_responsive.css">
                    <link rel="stylesheet" type="text/css" href="<?=URL?>assets/css/product_styles.css">
                    <link rel="stylesheet" type="text/css" href="<?=URL?>assets/css/product_responsive.css">
                    <link rel="stylesheet" type="text/css" href="<?=URL?>assets/css/cart_styles.css">
                    <link rel="stylesheet" type="text/css" href="<?=URL?>assets/css/cart_responsive.css">
                    <link rel="stylesheet" type="text/css" href="<?=URL?>assets/css/contact_styles.css">
                    <link rel="stylesheet" type="text/css" href="<?=URL?>assets/css/contact_responsive.css">

                </head>

                <body>

                    <div class="super_container">

                        <!-- Header -->

                        <header class="header">

                            <!-- Header Main -->

                            <div class="header_main">
                                <div class="container">
                                    <div class="row">

                                        <!-- Logo -->
                                        <div class="col-lg-2 col-sm-3 col-3 order-1">
                                            <div class="logo_container">
                                                <div class="logo"><a href="#">Techstore</a></div>
                                            </div>
                                        </div>

                                        <!-- Search -->
                                        <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                                            <div class="header_search">
                                                <div class="header_search_content">
                                                    <div class="header_search_form_container">
                                                        <form action="#" class="header_search_form clearfix">
                                                            <input type="search" required="required" class="header_search_input" placeholder="Search for products...">
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
                                                            <button type="submit" class="header_search_button trans_300" value="Submit"><img src="assets/images/search.png" alt=""></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Wishlist -->
                                        <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                                            <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                                                <!-- Cart -->
                                                <div class="cart">
                                                    <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                                        <div class="cart_icon">
                                                            <img src="assets/images/cart.png" alt="">
                                                            <div class="cart_count"><span>10</span></div>
                                                        </div>
                                                        <div class="cart_content">
                                                            <div class="cart_text"><a href="#">Cart</a></div>
                                                            <div class="cart_price">$85</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Main Navigation -->

                            <nav class="main_nav">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">

                                            <div class="main_nav_content d-flex flex-row">

                                                <!-- Categories Menu -->

                                                <div class="cat_menu_container">
                                                    <div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
                                                        <div class="cat_burger"><span></span><span></span><span></span></div>
                                                        <div class="cat_menu_text">categories</div>
                                                    </div>

                                                    <ul class="cat_menu">
                                                        <li><a href="#">Computers & Laptops <i class="fas fa-chevron-right ml-auto"></i></a></li>
                                                        <li><a href="#">Cameras & Photos<i class="fas fa-chevron-right"></i></a></li>
                                                        <li><a href="#">Smartphones & Tablets<i class="fas fa-chevron-right"></i></a></li>
                                                        <li><a href="#">TV & Audio<i class="fas fa-chevron-right"></i></a></li>
                                                        <li><a href="#">Gadgets<i class="fas fa-chevron-right"></i></a></li>
                                                        <li><a href="#">Car Electronics<i class="fas fa-chevron-right"></i></a></li>
                                                        <li><a href="#">Video Games & Consoles<i class="fas fa-chevron-right"></i></a></li>
                                                        <li><a href="#">Accessories<i class="fas fa-chevron-right"></i></a></li>
                                                    </ul>
                                                </div>

                                                <!-- Main Nav Menu -->

                                                <div class="main_nav_menu ml-auto">
                                                    <ul class="standard_dropdown main_nav_dropdown">
                                                        <li><a href="#">Home<i class="fas fa-chevron-down"></i></a></li>
                                                        <li><a href="#">All products<i class="fas fa-chevron-down"></i></a></li>
                                                        <li><a href="#">Cart<i class="fas fa-chevron-down"></i></a></li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </nav>

                        </header>
            ----------------------------------------------------------------------------------------------------------------------------------------------------------------
            inc/footer.php:
                	<?php require_once("app.php");?>

                        <!-- Copyright -->

                        <div class="copyright">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        
                                        <div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                                            <div class="copyright_content"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                                            </div>
                                            <div class="logos ml-sm-auto">
                                                <ul class="logos_list">
                                                    <li><a href="#"><img src="<?=URL?>assets/images/logos_1.png" alt=""></a></li>
                                                    <li><a href="#"><img src="<?=URL?>assets/images/logos_2.png" alt=""></a></li>
                                                    <li><a href="#"><img src="<?=URL?>assets/images/logos_3.png" alt=""></a></li>
                                                    <li><a href="#"><img src="<?=URL?>assets/images/logos_4.png" alt=""></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="<?=URL?>assets/js/jquery-3.3.1.min.js"></script>
                    <script src="<?=URL?>assets/css/bootstrap4/popper.js"></script>
                    <script src="<?=URL?>assets/css/bootstrap4/bootstrap.min.js"></script>
                    <script src="<?=URL?>assets/plugins/greensock/TweenMax.min.js"></script>
                    <script src="<?=URL?>assets/plugins/greensock/TimelineMax.min.js"></script>
                    <script src="<?=URL?>assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
                    <script src="<?=URL?>assets/plugins/greensock/animation.gsap.min.js"></script>
                    <script src="<?=URL?>assets/plugins/greensock/ScrollToPlugin.min.js"></script>
                    <script src="<?=URL?>assets/plugins/slick-1.8.0/slick.js"></script>
                    <script src="<?=URL?>assets/plugins/easing/easing.js"></script>
                    <script src="<?=URL?>assets/plugins/Isotope/isotope.pkgd.min.js"></script>
                    <script src="<?=URL?>assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
                    <script src="<?=URL?>assets/plugins/parallax-js-master/parallax.min.js"></script>
                    <script src="<?=URL?>assets/js/custom.js"></script>
                    <script src="<?=URL?>assets/js/shop_custom.js"></script>
                    <script src="<?=URL?>assets/js/product_custom.js"></script>
                    <script src="<?=URL?>assets/js/cart_custom.js"></script>

                    </body>

                    </html>  
                    
            ----------------------------------------------------------------------------------------------------------------------------------------------------------------
            index.php:
                <?php include("inc/header.php")?>
	
                    <!-- Banner -->

                    <div class="banner">
                        <div class="banner_background" style="background-image:url(images/banner_background.jpg)"></div>
                        <div class="container fill_height">
                            <div class="row fill_height">
                                <div class="banner_product_image"><img src="<?=URL?>assets/images/banner_product.png" alt=""></div>
                                <div class="col-lg-5 offset-lg-4 fill_height">
                                    <div class="banner_content">
                                        <h1 class="banner_text">new era of smartphones</h1>
                                        <div class="banner_price"><span>$530</span>$460</div>
                                        <div class="banner_product_name">Apple Iphone 6s</div>
                                        <div class="button banner_button"><a href="#">Shop Now</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php include("inc/footer.php")?>
            ----------------------------------------------------------------------------------------------------------------------------------------------------------------
            
            category.php:
                <?php include("inc/header.php")?>	
	
                    <!-- Home -->
                    <div class="home">
                        <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?=URL?>assets/images/shop_background.jpg"></div>
                        <div class="home_overlay"></div>
                        <div class="home_content d-flex flex-column align-items-center justify-content-center">
                            <h2 class="home_title">Category Name Here</h2>
                        </div>
                    </div>

                    <!-- Shop -->

                    <div class="shop">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3">

                                    <!-- Shop Sidebar -->
                                    <div class="shop_sidebar">
                                        <div class="sidebar_section">
                                            <div class="sidebar_title">Categories</div>
                                            <ul class="sidebar_categories">
                                                <li><a href="#">Computers & Laptops</a></li>
                                                <li><a href="#">Cameras & Photos</a></li>
                                                <li><a href="#">Hardware</a></li>
                                                <li><a href="#">Smartphones & Tablets</a></li>
                                                <li><a href="#">TV & Audio</a></li>
                                                <li><a href="#">Gadgets</a></li>
                                                <li><a href="#">Car Electronics</a></li>
                                                <li><a href="#">Video Games & Consoles</a></li>
                                                <li><a href="#">Accessories</a></li>
                                            </ul>
                                        </div>
                                        
                                    </div>

                                </div>

                                <div class="col-lg-9">
                                    
                                    <!-- Shop Content -->

                                    <div class="shop_content">

                                        <div class="product_grid">
                                            <div class="product_grid_border"></div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/1.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$225</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Philips BT6900A</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/2.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$225</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Huawei MediaPad...</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/3.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$379</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Apple iPod shuffle</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/4.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$225</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Sony MDRZX310W</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                                
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/5.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$379</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">LUNA Smartphone</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                                
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/6.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$379</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Canon IXUS 175...</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                                
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/7.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$379</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Canon STM Kit...</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                                
                                            </div>


                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/8.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$225</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Rapoo 7100p Gray</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/9.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$379</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Canon EF</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/10.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$225</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Gembird SPK-103</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

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

                <?php include("inc/footer.php")?>
            ----------------------------------------------------------------------------------------------------------------------------------------------------------------
            products.php:
                <?php include("inc/header.php")?>
	
                    <!-- Home -->

                    <div class="home">
                        <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?=URL?>assets/images/shop_background.jpg"></div>
                        <div class="home_overlay"></div>
                        <div class="home_content d-flex flex-column align-items-center justify-content-center">
                            <h2 class="home_title">All Products</h2>
                        </div>
                    </div>

                    <!-- Shop -->

                    <div class="shop">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3">

                                    <!-- Shop Sidebar -->
                                    <div class="shop_sidebar">
                                        <div class="sidebar_section">
                                            <div class="sidebar_title">Categories</div>
                                            <ul class="sidebar_categories">
                                                <li><a href="#">Computers & Laptops</a></li>
                                                <li><a href="#">Cameras & Photos</a></li>
                                                <li><a href="#">Hardware</a></li>
                                                <li><a href="#">Smartphones & Tablets</a></li>
                                                <li><a href="#">TV & Audio</a></li>
                                                <li><a href="#">Gadgets</a></li>
                                                <li><a href="#">Car Electronics</a></li>
                                                <li><a href="#">Video Games & Consoles</a></li>
                                                <li><a href="#">Accessories</a></li>
                                            </ul>
                                        </div>
                                        
                                    </div>

                                </div>

                                <div class="col-lg-9">
                                    
                                    <!-- Shop Content -->

                                    <div class="shop_content">

                                        <div class="product_grid">
                                            <div class="product_grid_border"></div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/1.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$225</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Philips BT6900A</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/2.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$225</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Huawei MediaPad...</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/3.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$379</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Apple iPod shuffle</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/4.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$225</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Sony MDRZX310W</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                                
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/5.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$379</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">LUNA Smartphone</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                                
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/6.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$379</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Canon IXUS 175...</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                                
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/7.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$379</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Canon STM Kit...</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                                
                                            </div>


                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/8.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$225</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Rapoo 7100p Gray</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/9.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$379</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Canon EF</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/10.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$225</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Gembird SPK-103</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

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

                <?php include("inc/footer.php")?>
            ----------------------------------------------------------------------------------------------------------------------------------------------------------------
            search.php:
                <?php include("inc/header.php")?>
                    
                    <!-- Home -->

                    <div class="home">
                        <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?=URL?>assets/images/shop_background.jpg"></div>
                        <div class="home_overlay"></div>
                        <div class="home_content d-flex flex-column align-items-center justify-content-center">
                            <h2 class="home_title">Search results for: keyword here</h2>
                        </div>
                    </div>

                    <!-- Shop -->

                    <div class="shop">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3">

                                    <!-- Shop Sidebar -->
                                    <div class="shop_sidebar">
                                        <div class="sidebar_section">
                                            <div class="sidebar_title">Categories</div>
                                            <ul class="sidebar_categories">
                                                <li><a href="#">Computers & Laptops</a></li>
                                                <li><a href="#">Cameras & Photos</a></li>
                                                <li><a href="#">Hardware</a></li>
                                                <li><a href="#">Smartphones & Tablets</a></li>
                                                <li><a href="#">TV & Audio</a></li>
                                                <li><a href="#">Gadgets</a></li>
                                                <li><a href="#">Car Electronics</a></li>
                                                <li><a href="#">Video Games & Consoles</a></li>
                                                <li><a href="#">Accessories</a></li>
                                            </ul>
                                        </div>
                                        
                                    </div>

                                </div>

                                <div class="col-lg-9">
                                    
                                    <!-- Shop Content -->

                                    <div class="shop_content">

                                        <div class="product_grid">
                                            <div class="product_grid_border"></div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/1.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$225</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Philips BT6900A</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/2.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$225</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Huawei MediaPad...</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/3.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$379</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Apple iPod shuffle</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/4.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$225</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Sony MDRZX310W</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                                
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/5.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$379</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">LUNA Smartphone</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                                
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/6.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$379</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Canon IXUS 175...</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                                
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/7.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$379</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Canon STM Kit...</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                                
                                            </div>


                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/8.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$225</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Rapoo 7100p Gray</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/9.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$379</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Canon EF</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

                                            <!-- Product Item -->
                                            <div class="product_item">
                                                <div class="product_border"></div>
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="uploads/10.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_price">$225</div>
                                                    <div class="product_name"><div><a href="#" tabindex="0">Gembird SPK-103</a></div></div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-cart-plus"></i></div>
                                            </div>

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

                <?php include("inc/footer.php")?>
                    
            ----------------------------------------------------------------------------------------------------------------------------------------------------------------
            product.php:
                <?php include("inc/header.php")?>

                    <!-- Single Product -->

                    <div class="single_product">
                        <div class="container">
                            <div class="row">
                                <!-- Selected Image -->
                                <div class="col-lg-6 order-lg-2 order-1">
                                    <div class="image_selected"><img src="<?=URL?>assets/images/single_4.jpg" alt=""></div>
                                    <!-- <div class="image_selected "><img src="uploads/2.jpg" alt=""></div> -->
                                </div>

                                <!-- Description -->
                                <div class="col-lg-6 order-3">
                                    <div class="product_description">
                                        <div class="product_category">Laptops</div>
                                        <div class="product_name">MacBook Air 13</div>
                                        <div class="product_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum. laoreet turpis, nec sollicitudin dolor cursus at. Maecenas aliquet, dolor a faucibus efficitur, nisi tellus cursus urna, eget dictum lacus turpis.</p></div>
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

                                                    <div class="product_price">$2000</div>

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

                <?php include("inc/footer.php")?>
            --------------------------------------------------------------------------------------------------------------------------------------------------------------
            cart.php:
                <?php include("inc/header.php")?>

                    <!-- Cart -->

                    <div class="cart_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-1">
                                    <div class="cart_container">
                                        <div class="cart_title">Shopping Cart</div>
                                        <div class="cart_items">
                                            <ul class="cart_list">
                                                <li class="cart_item clearfix">
                                                    <div class="cart_item_image"><img src="images/shopping_cart.jpg" alt=""></div>
                                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                                        <div class="cart_item_name cart_info_col">
                                                            <div class="cart_item_title">Name</div>
                                                            <div class="cart_item_text">MacBook Air 13</div>
                                                        </div>
                                                        <div class="cart_item_quantity cart_info_col">
                                                            <div class="cart_item_title">Quantity</div>
                                                            <div class="cart_item_text">1</div>
                                                        </div>
                                                        <div class="cart_item_price cart_info_col">
                                                            <div class="cart_item_title">Price</div>
                                                            <div class="cart_item_text">$2000</div>
                                                        </div>
                                                        <div class="cart_item_total cart_info_col">
                                                            <div class="cart_item_title">Total</div>
                                                            <div class="cart_item_text">$2000</div>
                                                        </div>
                                                        <div class="cart_item_action cart_info_col">
                                                            <div class="cart_item_title">Remove</div>
                                                            <div class="cart_item_text">
                                                                <a href="#">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        
                                        <!-- Order Total -->
                                        <div class="order_total">
                                            <div class="order_total_content text-md-right">
                                                <div class="order_total_title">Order Total:</div>
                                                <div class="order_total_amount">$2000</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact_form">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-1">
                                    <div class="contact_form_container">
                                        <div class="contact_form_title">Fill in your info</div>

                                        <form action="#" id="order_form">
                                            <div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
                                                <input type="text" id="contact_form_name" class="contact_form_name input_field" placeholder="Your name">
                                                <input type="text" id="contact_form_email" class="contact_form_email input_field" placeholder="Your email">
                                                <input type="text" id="contact_form_phone" class="contact_form_phone input_field" placeholder="Your phone number">
                                            </div>
                                            <div class="contact_form_text">
                                                <textarea id="contact_form_message" class="text_field contact_form_message" rows="4" placeholder="Your address"></textarea>
                                            </div>
                                            <div class="contact_form_button">
                                                <button type="submit" class="button contact_submit_button">Submit Order</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel"></div>
                    </div>
                    
                <?php include("inc/footer.php")?> 
            
    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    Database Credentials:
        -in app.php we will add database configurations(db name, username, pass, ....)
        -go to Db.php and use these constants
        -we don't need to require/include app.php in Db.php
        
        -because we will use Db and models classes in  pages(index,products, product, cart, category,search)which will include header and footer and (header and footer) already included (app.php)
        -if we want to require/include in Db ,we use require_once() for safety
        
        Example:
            app.php:
                //db credentials
                define("DB_SERVERNAME", "localhost");
                define("DB_USERNAME", "root");
                define("DB_PASSWORD", "");
                define("DB_NAME", "techstore");
                define("DB_PORT", 3306);

            Db.php:
                public function connect(){
                    $this->conn = mysqli_connect(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
                }
            
    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Including Classes:
        -we want to include all classes that we made 
        -so that we can use them in any page
        -since all pages required header and footer and (header and footer) already required app.php
        
        -this method/step has problems:
            -when we make new class , we have to require it in app.php
            -some pages don't need to required all classes, it just needs some classes

        -we will use autoloading later instead of this step to solve these problems

        app.php:
            //include classes
            require_once(PATH."classes/Request.php");
            require_once(PATH."classes/Session.php");
            require_once(PATH."classes/Db.php");
            require_once(PATH."classes/Models/Cat.php");
            require_once(PATH."classes/Models/Order.php");
            require_once(PATH."classes/Models/OrderDetail.php");
            require_once(PATH."classes/Models/Product.php");
            require_once(PATH."classes/Validation/ValidationRule.php");
            require_once(PATH."classes/Validation/Required.php");
            require_once(PATH."classes/Validation/Numeric.php");
            require_once(PATH."classes/Validation/Email.php");
            require_once(PATH."classes/Validation/Max.php");
            require_once(PATH."classes/Validation/Str.php");
            require_once(PATH."classes/Validation/Validator.php");

    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    -objects:
        -there are 2 classes , that we will need to use them many times which are session , request
        
        -so instead of making many objects from them to use them 
        -we will make one object in app.php and use them

        Example:
            app.php:
                //objects
                $request = new Request();
                $session = new Session();

    
*/

