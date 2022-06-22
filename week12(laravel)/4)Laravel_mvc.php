<?php

/*
MVC (Model - View - Controller) :is a design Pattern
- we request from Controller then controller thinks whether to go to View or Model
- we can get back from Model to Controller then go to View to display

-Laravel , angular based on MVC 

-There are Several Important Folders in Laravel Project:
    1)routes
    2)resources
    3)app
    4)config

    1)routes: 
        -anything written in the URL  : localhost:8000/
        
         -contains:
            -web.php file: when i make full web application
            -api.php file: when i make apis only
        

        -example for web.php:
            Route::get('/', function () {
                return view('welcome');
            });
        
        -Route is a class, get means static get method, function ()is a closure/callback function/anonymous function has no name (what will function do when return)

        - view is a function 
        -welcome is in resources/views/welcome.blade.php
        -welcome is the html page that i see 

        -if we put welcome.blade.php in a folder , we must change view function path return view('test/welcome'); or return view('test.welcome') 

        -we can make multiple routes so that when we request something in the URL , it will execute certain function
        example : when user write /test in url , it will print hello
            Route::get('/test', function () {
                echo "Hello <br>";
            });

        - if we want to pass parameter in the URL(route) we use curly braces {param}
         example : when user write /test/{name} in url , it will print hello name
            Route::get('/test/{name}', function ($name) {
                echo "Hello $name <br>";
            });
        
        if we want the parameter to be optional , we use ? :{param?}
        example : when user write /test/{name?} in url , it will print hello name
            Route::get('/test/{name?}', function ($name = null) {
                echo "Hello $name <br>";
            });
        --------------------------------------------------------------------------------------------------
        
        -How/Where to Write functions and Execute ?: 
            1)First Method:
                -we can write small functions in routes/web.php , big functions will be written app/Http/Controllers/myControllerClass 

                -in app/Http/Controllers : we will create files that has classes which contains functions we want to write 

                -My Class should be in namespace : namespace App\Http\Controllers;

                -My Class should extends controller class :class TestController extends Controller{}
                -Write any function in my Class 
            
            2)Second Method:
                - we can use artisan to do all of these steps automatically by writing this command  : php artisan make:controller MyControllerName

            -then in Routes/web.php : use the namespace of myClass : namespace App\Http\Controllers\MyClassName;
            -in laravel we don't need to require class file, we can just use it
            -To execute function :
                Route::get('/test2', [TestController::class, "test"]);
                
                -we will call test function from TestController Class
        --------------------------------------------------------------------------------------------------------------
        Pass Parameters by Location:

            -we can make functions in controller that takes parameters by location/reference from url/get/post 
            -example :
            routes/web.php : 
                Route::get('/sum/{n1}/{n2}', [CalcController::class, "sum"]);
            app/http/controllers/CalcController : 
                function sum($x, $y){
                    echo "$x + $y = " .($x + $y);
                }
        ----------------------------------------------------------------------------------------------------------------------------
        Putting Validation Rules on Route parameters :
                -example if we want to enter numbers only:
                    Route::get('/sum/{n1}/{n2?}', [CalcController::class, "sum"])->where("n1", "[0-9]+");
                        
                    another way:
                    Route::get('/sum/{n1}/{n2?}', [CalcController::class, "sum"])->whereNumber("n1");    

                -example if we want to enter letters only:
                    Route::get('/test/{name?}', function ($name = null) {
                        echo "Hello $name <br>";
                    })->where("name", "[a-zA-Z]*");

                    another way:
                    Route::get('/test/{name?}', function ($name = null) {
                        echo "Hello $name <br>";
                    })->whereAlpha("name");
                
                -example on alphaNumeric:->whereAlphaNumeric('name')

                -example on multiple_Validations :->whereNumber('id')->whereAlpha('name')
                
                -example to check value entered is in certain values or not : ->whereIn('category', ['movie', 'song', 'painting']);
                
                -example on Encoded Forward Slashes:
                    -The Laravel routing component allows all characters except / to be present within route parameter values. You must explicitly allow / to be part of your placeholder using a where condition regular expression:

                    app/http/controllers/CalcController : 
                        function search(Request $request){
                            dump($request->search);//to dump a variable’s contents to the browse
                        }
                    route/web.php:
                        Route::get("/search/{search}", [CalcController::class, "search"])->where("search", ".*"); //. means any character



                -instead of putting rule for every function , we can put global rules in app/providers/RouteServiceProvider.php
                    example:
                        app/providers/RouteServiceProvider.php:
                            public function boot()
                            {
                                Route::pattern('name', '[a-z]+');
                            }
                        
                        route/web.php:
                            Route::get('/test/{name?}', function ($name = null) {
                                echo "Hello $name <br>";
                            });
                            -any name parameter will have this restrictions/validations
        -----------------------------------------------------------------------------------------------------------------------------------------  
        -Conclusion:
            -we can now take from url/route to controller function through requests
            -now we want to pass the results to view to display on my design
       
        -(How to Deal with Views)/displaying Results in Resources/view/myDesign.php:
                example :
                -we want when we write welcome in url , then execute function welcome in TestController.php then go to show.php in view
                -we will create show.php to put my design
                -we can send parameters to view through several ways:
                        - return view("show")->with("name", $name);
                        -using Associative array as parameter in view : return view("show", ["name"=>$name]);

                Route::get("/welcome/{name}", [TestController::class, "welcome"]);
                
                function welcome($name){
                    // return view("show")->with("name", $name);
                    return view("show", ["name"=>$name]);
                }

                resources/views/show.php : 
        ---------------------------------------------------------------------------------------------------------------
        
        

    
    ///////////////////////////////////////////////////////////////////////////////////////
     
    2)app Folder:
        2.1)Controllers subFolder:
            -in app/Http/Controllers : we will create files that has classes which contains functions we want to write so that routes/web.php won't contain huge code 

            -My Class should be in namespace : namespace App\Http\Controllers;

            -My Class should extends controller class :class TestController extends Controller{}
            -Write any function in my Class 

            -then in Routes/web.php : use the namespace of myClass : namespace App\Http\Controllers\MyClassName;
            -in laravel we don't need to require class file, we can just use it
            
            -we can use artisan to do all of these steps automatically by writing this command  : php artisan make:controller MyControllerName

            -To execute function :
                Route::get('/test2', [TestController::class, "test"]);
                
                -we will call test function from TestController Class

            ----------------------------------------------------------------------------------------
            Pass Parameters by Location:

                -we can make functions in controller that takes parameters by location/reference from url/get/post 
                -example :
                routes/web.php : 
                    Route::get('/sum/{n1}/{n2}', [CalcController::class, "sum"]);
                app/http/controllers/CalcController : 
                    function sum($x, $y){
                        echo "$x + $y = " .($x + $y);
                    }

            ------------------------------------------------------------------------------------------------

            Receive parameters by using request object (class for request superglobal array):
                -request object contain all variables send by get/post/..
                Example :
                    function sum2(Request $request){
                        $x = $request->n1;
                        $y = $request->n2;
                        echo "$x + $y = " .($x + $y);
                    }

                    Route::get('/sum2/{n1}/{n2}', [CalcController::class, "sum2"]);
        +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        2.2)Providers subFolder:
            -where we can put anything global constraints
            -RouteServiceProvider.php: where we can put global rules/pattern inside boot() method for any parameter
                    example:
                        public function boot()
                        {
                            Route::pattern('name', '[a-z]+');
                        }
                        
                        route/web.php:
                            Route::get('/test/{name?}', function ($name = null) {
                                echo "Hello $name <br>";
                            });
                        -any name parameter will have this restrictions/validations


    3)Resources Folder: 
        -anything related to UI , we will put it in resourses/views                   
    
    4)config Folder:
        4.1)database.php : 
            -contain all configurations needed , we will not change in it
            - we will change the configurations of databases in the .env file
            -laravel contain helper function called env() check if key/constant exists in .env file or not 
            - if exists then take it from .env , if not exists then take if from default in database.php
            -example 
                'host' => env('DB_HOST', '127.0.0.1'),  
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

-Laravel Extensions:
        1)Laravel Extension Pack
        2)Laravel goto view
        3)Laravel Goto Controller
        4)Laravel Extra Intellisense
        5)Laravel Blade Snippets
        6)php intelephense 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

-How to deal with DataBases in Laravel:
    1)
        -there is a class in laravel called DB : we can insert , create, delete ,select, table, .....
        -we must use its namespace : use Illuminate\Support\Facades\DB;
        example : 
                function demo(){
                    $rslt = DB::select("select * from regions");
                    dump($rslt);
                }
        -but we must first set the configuration of database used , username, password, port, ......
        Laravel contain config Folder:
            database.php : 
                -contain all configurations needed , we will not change in it
                - we will change the configurations of databases in the .env file 
                -laravel contain helper function called env() check if key/constant exists in .env file or not 
                - if exists then take it from .env , if not exists then take if from default in database.php
                -example 
                    'host' => env('DB_HOST', '127.0.0.1'), 
        
        example2 display all records without write sql in db class: 
                 function demo(){
                    $rslt = DB::table("regions")->get();
                    dump($rslt);
                }
        
    2)Eloquent(مميز) model:
        -we can deal with databases through models 
        -model name is similar to table name
        -to create model write this command :php artisan make:model my_model_name
        -model is created in app/models

        example :
            function demo(){
                //using model
                $rslt = Region::get();
                // $rslt = Region::find(10);

                dump($rslt);
            }
            
*/