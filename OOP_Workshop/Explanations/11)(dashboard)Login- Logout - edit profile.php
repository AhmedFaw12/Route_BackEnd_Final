<?php  
/*
Dashboard:
    Intro:
        -dashboard is for admins
        -it will control all things(categories, products) that appear to users 
        -also it will reveive orders from cart , and approve or cancel it
        -we will make folder admin where we will put dashboard files
        -change .html to .php
        -make header.php and footer.php and put common parts in them, and include header and footer in all admin files except login.php

        -we will make folder assets to contain js,css, images, plugins and adjust links in pages
        -header.php will require app.php , and we will adjust js , css paths of links

        -we will make in app.php , (APATH and AURL) which go to admin folder directly instead of repeating it manually

        app.php:
            define("APATH", __DIR__."/admin/");
            define("AURL", "http://localhost/OOP_Workshop/techstore/admin/");

        admin/inc/header.php:
            <?php require_once("../app.php"); ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Techstore | Dashboard</title>

                <link rel="stylesheet" href="<?=AURL;?>assets/css/bootstrap.min.css">
                <link rel="stylesheet" href="<?=AURL;?>assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css">
            </head>
        admin/inc/footer.php:
                <script src="<?=AURL;?>assets/js/jquery-3.5.1.min.js"></script>
                <script src="<?=AURL;?>assets/js/bootstrap.bundle.min.js"></script>
            </body>
            </html>

        admin/login.php:
            <?php  require_once("../app.php");?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Techstore | Dashboard</title>

                <link rel="stylesheet" href="<?=AURL;?>assets/css/bootstrap.min.css">
                <link rel="stylesheet" href="<?=AURL;?>assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css">
            </head>

            <body>
                //code

                <script src="<?=AURL;?>assets/js/jquery-3.5.1.min.js"></script>
                <script src="<?=AURL;?>assets/js/bootstrap.bundle.min.js"></script>
            </body>
            </html>
    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    Login:
        classes/Models/Admin.php:
             public function login(string $email, string $password, Session $session){
                $sql = "SELECT * FROM $this->table WHERE email = '$email' LIMIT 1";
                $result = mysqli_query($this->conn, $sql);

                $admin = mysqli_fetch_assoc($result);

                if(!empty($admin)){
                    $hashedPassword = $admin["password"];
                    $isSame = password_verify($password, $hashedPassword);
                    if($isSame){
                        $session->set("adminId", $admin["id"]);
                        $session->set("adminName", $admin["name"]);
                        $session->set("adminEmail", $admin["email"]);

                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }

            -we made a model class for admin 
            -we added new methods login and logout
            -login method will get email and password as parameters
            -search/select this email and get all admindata(password,email, name) from table

            -if email not found return false
            -if email found :
                we will use password_verify built in method to compare between password passed as parameter and hashedPassword we got from admins table
                
                -if password is the same , then save admin data in the session and return true
                -we can't use global variables inside functions so we have 2 solutions:
                    1st solution: we pass session variable as a parameter to the function
                    2nd solution: we use global keyword inorder to use global variable session

                    -we will use 1st solutions

                -if password not the same , return false


    
        ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        admin/login.php:
            <div class="card-body p-5">
                <?php include(APATH ."inc/messages.php"); ?>

                <form method="POST" action="<?=AURL;?>handlers/handle-login.php">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name= "email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="text-center mt-5">
                        <button type="submit" name="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>

            -we made a form to login
            -we made inputs for email, password and gave them names
            -we also gave name to submit button
            -we made method POST and action go to handle-login.php

            -we displayed error messages in case of validation/incorrect credintials errors
        ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        classes/Request.php:
            public function redirect($path){
                header("location: ". URL .$path);
            }

            public function aredirect($path){
                header("location: ". AURL .$path);
            }

            -we made a new redirect method inorder to redirect to files inside admin folder
        ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        admin/handlers/handle-login.php:
            <?php  
            require("../../app.php");

            use TechStore\Classes\Models\Admin;
            use TechStore\Classes\Validation\Validator;



            if($request->postHas('submit') ){
                
                $email = $request->post("email");
                $password = $request->post("password");

                //validation
                $validator = new Validator;
                
                $validator->validate("email", $email, ["required","email", "max"]);
                $validator->validate("password", $password, ["required", "str", "max"]);
                
                
                if($validator->hasErrors()){
                    $session->set("errors", $validator->getErrors());
                    $request->aredirect("login.php");
                }else{
                    
                    $ad =  new Admin;
                    $isLogin = $ad->login($email, $password, $session);
                    
                    if($isLogin){
                        $session->set("success", "You logged in Successfully");
                        $request->aredirect("index.php");
                    }else{
                        $session->set("errors", ["Credentials are not correct"]);            
                        $request->aredirect("login.php");
                    }
                }

            }else{
                $session->set("errors", ["Please Login First"]);  
                $request->aredirect("login.php");
            }
            ?>

            -we made sure that admin login through form submit button
            -we received inputs
            -we validated inputs using validator class we made earlier
            -if there were validation errors ,save these errors in session and redirect to login.php
            -if there were no validation errors:
                -made object of admin model class
                -used login method
                -if login is correct, then save a success message in session and redirect to admin/index.php

                -if login is not correct, save error message in session and redirect to login.php
        ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        admin/inc/messages.php:
            <?php if($session->has("errors")): ?>
                <div class="alert alert-danger">
                    <?php foreach($session->get("errors") as $error): ?>
                        <p class="mb-0"><?= $error ?></p>
                    <?php endforeach; $session->remove("errors");?>
                </div>
            <?php endif; ?>


            <?php if($session->has("success")): ?>
                <div class="alert alert-success text-center">
                    <p class="mb-0"><?= $session->get("success") ?></p>
                </div>
            <?php endif; $session->remove("success");?>

        ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        admin/inc/header.php:
            <?php  

            if(!$session->has("adminId")){
            $request->aredirect("login.php");
            }
            ?>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= $session->get("adminName")?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="<?=AURL;?>handlers/handle-logout.php">Logout</a>
                </div>
            </li>
            <nav>
            </nav>
            
            <?php include(APATH. "inc/messages.php")?>
            
            -if session does not have admin data , it will not display dashboard pages for user
            -so admin must login
            -we displayed admin name
            -we made link to logout

            -display success message when login 
    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Logout:
        classes/models/Admin.php:
            public function logout(Session $session):void{
                $session->remove("adminId");
                $session->remove("adminName");
                $session->remove("adminEmail");
            }

            -we made a function to remove admin keys from the session

        admin/inc/header.php:
            <a class="dropdown-item" href="<?=AURL;?>handlers/handle-logout.php">Logout</a>

            -we made a link that go to logout handle to logout

        admin/handlers/handler-logout.php:
            <?php  

            use TechStore\Classes\Models\Admin;

            require_once("../../app.php");

            $adminName = $session->get("adminName");
            $session->set("success", "GoodBye $adminName");

            $ad = new Admin;
            $ad->logout($session);

            $request->aredirect("login.php");
            ?>

            -we will require app.php
            -save a goodbye message in session

            -use Admin model class
            -logout
            -redirect to login.php
    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Edit Profile:
        admin/inc/header.php:
            <a class="dropdown-item" href="<?=AURL;?>profile.php">Profile</a>

            <?php include(APATH. "inc/messages.php")?>


            -we made a link to go to profile.php inorder to edit it if we wants
            -we will display success message after navbar when login
        ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        admin/profile.php:
             <form method="POST" action="<?=AURL;?>handlers/handle-profile.php">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?=$session->get("adminName")?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?=$session->get("adminEmail")?>">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label>Confrim Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                    
                <div class="text-center mt-5">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-dark" href="<?=AURL;?>">Back</a>
                </div>
            </form>

            -we made a form to edit profile
            -method is post and action is to go to handle-profile.php 
            -we made inputs for name, email, password, password_confirmation
            -we gave names for inputs and also gave a name for submit button

            -we displayed old name, email(which are stored in session) in the inputs
        ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        admin/handlers/handle-logout.php:
            <?php  
            require("../../app.php");

            use TechStore\Classes\Models\Admin;
            use TechStore\Classes\Validation\Validator;

            if($request->postHas('submit') ){
                
                $name = $request->post("name");
                $email = $request->post("email");
                $password = $request->post("password");
                $password_confirmation = $request->post("password_confirmation");

                //validation
                $validator = new Validator;
                
                $validator->validate("name", $name, ["required","str", "max"]);
                $validator->validate("email", $email, ["required","email", "max"]);

                if(!empty($password) && $password === $password_confirmation){
                    $validator->validate("password", $password, ["required", "str", "max"]);
                }
                
                if($validator->hasErrors()){
                    $session->set("errors", $validator->getErrors());
                    $request->aredirect("profile.php");
                    
                }else{
                    
                    $ad =  new Admin;
                    
                    if(!empty($password)){
                        //update query with password
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                        $ad->update("name = '$name', email = '$email', `password` = '$hashedPassword'", $session->get("adminId"));
                    }else{
                        //update query without password
                        $ad->update("name = '$name', email = '$email'", $session->get("adminId"));
                    }
                    $session->set("success", "Profile is edited Successfully");
                    $request->aredirect("handlers/handle-logout.php");
                }

            }else{
                $request->aredirect("login.php");
            }
            ?>

            -we received inputs from form
            -we will validate name, email
            -we will validate password only if:
                -password is not empty(because admin can choose to edit it or not)
                -and password === password_confirmation
            -if there are validation errors , go back to profile.php with errors
            -if no validation errors:
                    if password not empty:
                            update table with new values
                    -if password is empty:
                            update table with new values without password
                    
                    -then save a success message in session

                    -admin data in admins table in database is updated
                    -but admin data in session is not updated
                    -so after we update data in database we will logout 
                    -so that user will login again and save new data in session
        ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        admin/handlers/handle-logout.php:
            if(!$session->has("success")){
                $adminName = $session->get("adminName");
                $session->set("success", "GoodBye $adminName");
            }

            -don't save success message if there is already success message(success edit message)

*/
?> 