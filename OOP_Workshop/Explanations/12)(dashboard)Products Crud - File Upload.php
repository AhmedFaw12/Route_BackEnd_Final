<?php  
/*
Dashboard(Products Crud):
    Display products , categories, orders count:
        index.php:
            use TechStore\Classes\Models\Cat;
            use TechStore\Classes\Models\Order;
            use TechStore\Classes\Models\Product;

            $pr = new Product;
            $productsCount = $pr->getCount();


            $c = new Cat;
            $catsCount = $c->getCount();

            $ord = new Order;
            $ordersCount = $ord->getCount();


            <div class="card-header">Products</div>
            <div class="card-body">
                <div class="card-text d-flex justify-content-between align-items-center">
                    <h5><?= $productsCount ?></h5>
                    <a href="<?=AURL;?>products.php" class="btn btn-light">Show</a>
                </div>
            </div>

            <div class="card-header">Categories</div>
            <div class="card-body">
                <div class="card-text d-flex justify-content-between align-items-center">
                    <h5><?= $catsCount ?></h5>
                    <a href="<?=AURL;?>categories.php" class="btn btn-light">Show</a>
                </div>
            </div>

            <div class="card-header">Orders</div>
            <div class="card-body">
                <div class="card-text d-flex justify-content-between align-items-center">
                    <h5><?= $ordersCount ?></h5>
                    <a href="<?=AURL;?>orders.php" class="btn btn-light">Show</a>
                </div>
            </div>

            -we displayed count using getCount() we made in Db class



    Display Products:
        admin/inc/header.php:
            <li class="nav-item <?php if($active === "products") echo "active"?>">
                <a class="nav-link" href="<?=AURL;?>products.php">Products</a>
            </li>

            -we made a link to go to products.php
            -the link will be active(highlighted) when $active = products which will be set in products.php

        admin/index.php:
            <a href="<?=AURL;?>products.php" class="btn btn-light">Show</a>

            -we also made another links to show admin/products.php

        classes/Models/Product.php:
            public function selectAll(string $fields = "*") : array
            {
                $sql = "SELECT $fields FROM $this->table JOIN cats 
                        ON $this->table.cat_id = cats.id
                        ORDER BY $this->table.id DESC";
                        
                $result = mysqli_query($this->conn, $sql);

                return mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
            
            -we overrided selectAll method to get category name of each product using join
            -we will select and display products ordered by product id descendingly

        admin/products.php:
            <?php $active ="products"?>
            <?php  require_once("inc/header.php");?>

            <?php  

            use TechStore\Classes\Models\Product;

            $pr = new Product;
            $prods = $pr->selectAll("products.id AS prodId, products.name AS prodName, `desc`, price, pieces_no, img, products.created_at AS prodCreatedAt, cats.name AS catName");
            ?>

            <?php foreach($prods as $index => $prod): ?>
                <tr>
                    <th scope="row"><?= $index+1 ?></th>
                    <td><?= $prod["prodName"]; ?></td>
                    <td><?= $prod["catName"]; ?></td>
                    <td>
                        <img src="<?=URL . "uploads/" .$prod["img"]?>"  height="50px" alt="">
                    </td>
                    <td><?= $prod["pieces_no"]; ?></td>
                    <td>$<?= $prod["price"]; ?></td>
                    <td><?=date("d M,Y h:i a", strtotime($prod["prodCreatedAt"])) ; ?></td>
                    <td>
                        <!-- <a class="btn btn-sm btn-primary" href="#">
                            <i class="fas fa-eye"></i>
                        </a> -->
                        <a class="btn btn-sm btn-info" href="<?=AURL . "edit-product.php?id=". $prod["prodId"]?>">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-sm btn-danger" href="<?=AURL . "handlers/delete-product.php?id=". $prod["prodId"]?>">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>


            -we selected all products from db using selectAll()
            -we displayed all products using foreach
            -we should give our image some height = 50px because some images may be too big and corrupt view of my table
            
            -we displayed index of loop using $index 
            
            -to display date in certain format in php:
                -first we must convert our date(timestamp) to unix timestamp because php deals with time using unix timestamp
                -we use date(format, myunixtimestamp) to display date in certain format
    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    Create Product_ File Upload _FILE VALIDATION:
        admin/products.php:
            <a href="<?=AURL;?>add-product.php" class="btn btn-success">
                Add new
            </a>
            
            -made a link to go to add-product form page

        admin/add-product.php:
            <?php  
            use TechStore\Classes\Models\Cat;

            $c = new Cat;
            $cats = $c->selectAll("id, name");

            ?>

            <form method="POST" action="<?=AURL;?>handlers/add-product.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="cat_id">
                        <?php foreach($cats as $cat): ?>
                            <option value="<?=$cat["id"]?>"><?= $cat["name"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control">
                </div>

                <div class="form-group">
                    <label>Pieces</label>
                    <input type="number" name="pieces_no" class="form-control">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="desc" rows="3"></textarea>
                </div>
                
                <div class="custom-file">
                    <input type="file" name="img" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose Image</label>
                </div>
                    
                <div class="text-center mt-5">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-dark" href="<?=AURL;?>products.php">Back</a>
                </div>
            </form>

            -we made a form to submit products data we want to create
            -form action will go to add-product handler
            -form action is post 
            -form enctype="multipart/form-data : because we will upload file
            -we made inputs for:
                -name, description, price , pieces_no, img
                -cat_id , we made select option box and displayed cats names using foreach
                -we will give select a name , give options values of cats ids

                -we will also give submit button name

        
        classes/Request.php:
            public function files(string $key)
            {
                return $_FILES[$key];
            }

            -images/files are received by $_FILES superglobal variables , so we made a function to reveice files
            
            -$_FILES contains:
                $_FILES['file']['name'] - The original name(name+ext) of the file to be uploaded.

                $_FILES['file']['type'] - The mime type of the file.

                $_FILES['file']['size'] - The size, in bytes, of the uploaded file.

                $_FILES['file']['tmp_name'] - The temporary filename of the file in which the uploaded file was stored on the server.

                $_FILES['file']['error'] - The error code associated with this file upload.
                                            -if error = 0 , then there is no error
        
        classes/Validation/RequiredFile.php:
            <?php

            namespace TechStore\Classes\Validation;

            use TechStore\Classes\Validation\ValidationRule;

            class RequiredFile implements ValidationRule 
            {
                public function check(string $name, $value) :bool|string{
                    if($value['error'] != 0){
                        return "$name is required";   
                    }
                    return false;
                }
            }
            -we need validation rules for files(requiredFile)
            -if error != 0 , then there are errors 
        
        classes/Validation/Image.php:
            <?php

            namespace TechStore\Classes\Validation;

            use TechStore\Classes\Validation\ValidationRule;

            class Image implements ValidationRule 
            {
                public function check(string $name, $value) :bool|string{
                    $allowedExt = ["jpg", "png", "jpeg", "gif"];
                    $ext = pathinfo($value["name"], PATHINFO_EXTENSION);
                    
                    if(!in_array($ext, $allowedExt)){
                        return "$name extension is not allowed, please upload jpg,jpeg,png,gif";   
                    }
                    return false;
                }
            }
            -pathInfo() can get fileExtension
            -we made an array for allowed extensions
            -we will check if uploaded file extension is in allowedExt array or not


        classes/File.php:
            <?php  
            namespace TechStore\Classes;

            class File{

                private $name, $tmpName, $uploadName;
                public function __construct(array $file){
                    $this->name = $file["name"];
                    $this->tmpName = $file["tmp_name"];
                }

                public function rename():File{
                    $ext = pathinfo($this->name, PATHINFO_EXTENSION);
                    $randomStr = uniqid();
                    $this->uploadName = "$randomStr.$ext";

                    return $this;
                }

                public function upload():string{
                    $destination = PATH . "uploads/" . $this->uploadName;
                    move_uploaded_file($this->tmpName, $destination);

                    return $this->uploadName;
                }
            }

            -we made a class to controlls files(remonae ,upload to specific location)
            -uniqid() : will give a unique id string consists of 13 characters
            -we will change file name (because users may upload common filenames )
            -so we will change files names to unique files names (unique_ID.ext)

            -return $this :
                -it allows method chaining
                -Ex:
                    $file = new File($img);
                    $imgUploadName = $file->rename()->upload();
            
            -move_uploaded_file() :moves files from temporary file location to destination(which we will specify)
            
            ?>
        
        admin/handlers/add-product.php:
            <?php
            require_once("../../app.php");

            use TechStore\Classes\File;
            use TechStore\Classes\Models\Product;
            use TechStore\Classes\Validation\Validator;


            if($request->postHas("submit")){
                $name = $request->post("name");
                $cat_id = $request->post("cat_id");
                $price = $request->post("price");
                $pieces_no = $request->post("pieces_no");
                $desc = $request->post("desc");
                $img = $request->files("img");

                //validation
                $validator = new Validator();
                $validator->validate("name", $name, ["required", "str", "max"]);
                $validator->validate("cat_id", $cat_id, ["required", "numeric"]);
                $validator->validate("price", $price, ["required", "numeric"]);
                $validator->validate("pieces number", $pieces_no, ["required", "numeric"]);
                $validator->validate("description", $desc, ["required", "str"]);
                $validator->validate("image", $img, ["requiredfile", "image"]);

                if($validator->hasErrors()){
                    $session->set("errors", $validator->getErrors());
                    $request->aredirect("add-product.php");
                }else{
                    //upload img
                    $file = new File($img);
                    $imgUploadName = $file->rename()->upload();

                    //db query
                    $pr = new Product;
                    $pr->insert("name, `desc`, price, pieces_no, img, cat_id", "'$name', '$desc', $price, $pieces_no, '$imgUploadName', $cat_id");


                    $session->set("success", "product added successfully");
                    $request->aredirect("products.php");
                }
            }else{
                $request->aredirect("add-product.php");
            }

            ?>

            -we will receives inputs
            -validate inputs
            -returns errors to add-products form page , if there are validation errors
            -rename and move_uploaded_file to my location(uploads folder)
            -insert product data to database
            -save a success message
            

        admin/inc/header.php:
            <?php include(APATH."inc/messages.php")?>

            -we displayed messages in header to be displayed in all pages when needed
    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    Delete Product and delete file:
        admin/products.php:
            <a class="btn btn-sm btn-danger" href="<?=AURL . "handlers/delete-product.php?id=". $prod["prodId"]?>">
                <i class="fas fa-trash"></i>
            </a>

        admin/handlers/delete-product.php:
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

            -we receive product id
            -we select product from database and check if product exsists in database
            -we get image name and delete it from uploads folder
            -we delete product from database
            -save success message and redirect to products.php
    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    update/edit product:
        admin/products.php:
            <a class="btn btn-sm btn-info" href="<?=AURL . "edit-product.php?id=". $prod["prodId"]?>">
                <i class="fas fa-edit"></i>
            </a>


        admin/edit-product.php:
            use TechStore\Classes\Models\Product;
            use TechStore\Classes\Models\Cat;

            if($request->getHas("id")){
                $id = $request->get("id");
            }else{
                $id = 1;
            }

            $pr = new Product;
            $prod = $pr->selectId($id, "products.id AS prodId, products.name AS prodName, `desc`, price, pieces_no, img, cats.name AS catName, cats.id AS cat_id");

            $c = new Cat;
            $cats = $c->selectAll("id, name");

            ?>

            <form method="POST" action="<?=AURL;?>handlers/edit-product.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$id?>">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="<?=$prod["prodName"]?>" class="form-control">
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select name="cat_id" class="form-control">
                        <?php foreach($cats as $cat): ?>
                            <option  value="<?=$cat["id"]?>"  <?php if($cat["id"] == $prod["cat_id"]) {echo "selected";}?>><?=$cat["name"]?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" value="<?=$prod["price"]?>" class="form-control">
                </div>

                <div class="form-group">
                    <label>Pieces</label>
                    <input type="number" name="pieces_no" value="<?=$prod["pieces_no"]?>" class="form-control">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="desc" rows="3"><?=$prod["desc"]?></textarea>
                </div>
                    
                <div class="mb-3 d-flex justify-content-center">
                    <img src="<?=URL . "uploads/" .$prod['img'];?>" height="100px" alt="">
                </div>

                <div class="custom-file">
                    <input type="file" name="img" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose Image</label>
                </div>
                        
                <div class="text-center mt-5">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-dark" href="<?=AURL;?>products.php">Back</a>
                </div>
            </form>
            
            -we made id = 1 by default , incase no id is passed 
            -we selected prod data and all cats to be displayed as old values
            -we made a condition to  select old cat in select option box
            -we displayed old image in img tag



        admin/handlers/edit-product.php:
            <?php
            require_once("../../app.php");

            use TechStore\Classes\File;
            use TechStore\Classes\Models\Product;
            use TechStore\Classes\Validation\Validator;


            if($request->postHas("submit")){
                $id = $request->post("id");
                $name = $request->post("name");
                $cat_id = $request->post("cat_id");
                $price = $request->post("price");
                $pieces_no = $request->post("pieces_no");
                $desc = $request->post("desc");
                $img = $request->files("img");

                //validation
                $validator = new Validator();
                $validator->validate("id", $id, ["required", "numeric"]);
                $validator->validate("name", $name, ["required", "str", "max"]);
                $validator->validate("cat_id", $cat_id, ["required", "numeric"]);
                $validator->validate("price", $price, ["required", "numeric"]);
                $validator->validate("pieces number", $pieces_no, ["required", "numeric"]);
                $validator->validate("description", $desc, ["required", "str"]);
                if($img["error"] == 0){
                    $validator->validate("image", $img, ["image"]);
                }

                if($validator->hasErrors()){
                    $session->set("errors", $validator->getErrors());
                    $request->aredirect("edit-product.php");
                }else{

                    $pr = new Product;
                    $imgName = $pr->selectId($id, "img")["img"];
                    
                    //upload img if new one is sent
                    if($img["error"] == 0){
                        //select old image
                        unlink(PATH."uploads/$imgName");

                        //upload new image
                        $file = new File($img);
                        $imgName = $file->rename()->upload();
                    }
                    //update product data in database
                    $pr->update("name = '$name', cat_id='$cat_id', `desc`='$desc', price='$price', pieces_no = '$pieces_no', img='$imgName' ", $id);


                    $session->set("success", "product added successfully");
                    $request->aredirect("products.php");
                }
            }else{
                $request->aredirect("edit-product.php");
            }

            ?>

            -we received inputs 
            -validated inputs
            -image is optional
            -if there is new image, then delete old image from uploads folder, and upload new image
            -upadete prod data
*/
?>