<?php
/*
-Localization:
    -make my text in multiple languages
    -in lang folder , will make file for example (messages.php):
        -inside it we will do like in (auth.php , pagination.php, passwords.php, validation.php)
        -we will return an array with key and value :
            return [
                "Dashboard"=>"Dashboard",
                "Users"=>"Users",
                ""=>"",
                ""=>"",
                ""=>"",
                ""=>"",
                ""=>"",
                ""=>"",
                ""=>"",
                ""=>"",
            ];
        -we will use it in my UI 
    
    -how to use localization?
        - go to for example master.blade.php:

        - first way to use localization using trans() func and give it the key you want:
            {{trans("messages.Dashboard")}}
            
        - Second way to use localization using double underscore abbreviation:
            {{__("messages.Users")}}
    -------------------------------------------------------------------------------------------------------
    -How to make/translate to another language :
        -clear config cache : php artisan config:clear
        -copy en folder in lang folder
        -change name (en to ar)
        -go to messages.php and change values of array to arabic names
        -go to config/app :
            -change default lang
            -change 'locale' => 'en' to 'locale' => 'ar'

            -note : 
                'fallback_locale' => 'en' , :
                if there are some words/keys in arabic version of messages that are not translated , go to the english version of messages and take their values from there
                

    -------------------------------------------------------------------------------------------------------
    
    -How to switch between languages ? intro:
        -first method :
            -go to for example (web.php) :when we request "test" , we will change "locale" key to "ar"
            -there are multiple classes that change locale key :
                1)Config::set("filename.keyname", 'value'):
                    -config is a class that controls config folder and what is inside it
                    example :Config::set("app.locale", 'en');
                -2)App::setkeyname("value"):
                    -App is a class that controls app folder and what is inside it
                    -example : App::setLocale("en");
            
            -then print any key from messages.php:
                echo trans("messages.Departments");
            
            -this method is not good :
                -when we request/redirect again different route "/department"
                -it will go to master.blade and read all messages from config/app local key 
                -config and app classes changed key value in this request only ("/test")
            
            -we need before any request to execute code of set locale 
            -so we will use something called middleware
        ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    -Middleware(وسيط):
        -we only took that in route when we request something , we will go to controller , and controller will take us either to model or view

        -we can execute function before every controller function/request
        
        -when to use middleware:
            -in authentication : to see what privillages(صلاحية) does the user have
            -in localization

        How to define middleware?
            -to make middleware :
                -using command : php artisan make:middleware myName
                -it will create a class with myName in app/Http/Middleware 
                -it can have two methods :
                    - public function handle(Request $request, Closure $next){} :
                        paramters:
                            -request : 
                                -the request in the route  and the date send in the request (that is sent to controller ) will go first to the middleware
                                -depending on the request , we can check something 
                                
                            -next closure: 
                                -depending on the request , we can check something 
                                -if we want to continue , return $next($request)
                                -see where where were you going , and continue
                                
                                -for example (in route we requested '/test' , and test will go to view "xxx")
                                -so if we want to continue , return $next($request)

                                -also we can redirect to another view/page
                        -we will set locale in this function:   App::setLocale("en");
                        --------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                        -To execute this function:
                            -we need to connect my middleware class to all routes in the application
                            
                            kernel.php:
                                -there is file named : kernel.php inside app/Http folder
                                -this file tells us where to execute middlewares
                                -it has multiple arrays : 
                                    $middleware : if we write our middle inside it , it will be executed for all routes (in web.php , api.php)
                                        example: 
                                            protected $middleware = [
                                                ChangeLang::class,
                                            ]
                                    
                                    ,$middlewareGroups: if we write our middle inside it , we can put it with web group  (it will be executed for all routes in web.php), or api group ( it will be executed for all routes in api.php)

                    -terminate() method
--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-How to switch between languages ? continue:
    -we will switch/change languages using session 
    -session() method:
        -to control session
        -session()->put("keyname", "value") : to set keyname with value in session
        -session()->get("keyname") : to get value of keyname from session
        -session()->has("keyname") : to check if keyname exists in session

    steps to switch between languages:
        1)make  2 anchor links in UI :
            - 1 will route to "/change/ar"
            - 2 will route to "/change/en"

        2)make route in web.php :
            -that will receive request and set language in session 
            -go to middleware then redirect back to the page that made the request

        3) in my middleware : check if session has value for lang key and set locale with value using app:setLocale("en or ar")

        4) put my middleware class in kernel.php in $middlewareGroups array  in web group:
            - because $middleware array does not have middleware to start session , because it is made for both web and api , and apis do not use session

            -$middlewareGroups array  in web group  has default middleware to start session
        
    ------------------------------------------------------------------------------------------------------------
    Full example :
        master.blade:
             <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>{{__("messages.languages")}}</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="/change/en">
                    <span data-feather="file-text"></span>
                    English
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/change/ar">
                    <span data-feather="file-text"></span>
                    اللغة العربية
                    </a>
                </li>
            </ul>
        --------------------------------------------------------------------------------------------------------
        web.php:
            Route::get('/change/{lang}', function($lang){
                if($lang == "ar"){
                    session()->put("lang", "ar");
                }else{
                    session()->put("lang", "en");
                }
                return redirect()->back();
            });
        --------------------------------------------------------------------------------------------------------
        ChangeLang Middleware:
            public function handle(Request $request, Closure $next)
            {
                if(session()->has("lang") && session()->get("lang") == "ar"){
                    App::setLocale("ar");
                }else{
                    App::setLocale("en");
                }
                return $next($request);
            }
        -------------------------------------------------------------------------------------------------------
        kernel.php:
            protected $middlewareGroups = [
                'web' => [    
                    ChangeLang::class,
                ],

            
                      
*/