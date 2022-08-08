<!-- 
-we appear logout, login, register in the page according to the user (auth or guest)

-but if the user know the url to login or register, he can get login or register page, although we made them disappear

-we need to protect on our routes

-we have middleware named guest already made by laravel 
- also we have middleware named auth already made by laravel 

-middleware is something between request and controller

Example:
    web.php:
        Route::middleware(['guest'])->group(function () {
            Route::get("/register", [AuthController::class, 'registerForm']);//To get register form
            Route::post("/register", [AuthController::class, 'register']);//when user register

            Route::get("/login", [AuthController::class, 'loginForm']);//to get login form
            Route::post("/login", [AuthController::class, 'login']);//when user login
        });
        -guests who are not registered or log in , can enter these routes

        Route::middleware("auth")->group(function(){
            Route::post("/logout", [AuthController::class, 'logout']);
        });

        -users who are authenticated(registered or login) , can enter logout route
        
-->