<?php
/*
Switch Language:
    Steps:
        -make buttons/links in navbar. 
        -these button will save keys in session(lang) 
        -session value will be en or ar

    Full Example:
        layout.blade.php:
            {{-- switch language --}}
            @if(App::getLocale() == 'en')
                <li><a href={{url("/lang/set/ar")}}>ع</a></li>
            @else
                <li><a href={{url("/lang/set/en")}}>EN</a></li>
            @endif

            -we added buttons to change languages 
            -buttons will go to certain route

            -we added if condition so that is locale value is en , it will show only arabic button and vice versa

        web.php:
            Route::middleware("lang")->group(function(){
                Route::get('/',[HomeController::class, 'index']);
                Route::get('/categories/show/{id}',[CatController::class, 'show']);
                Route::get('/skills/show/{id}',[SkillController::class, 'show']);
                Route::get('/exams/show/{id}',[ExamController::class, 'show']);
                Route::get('/exams/questions/{id}',[ExamController::class, 'questions']);
            });
            Route::get('/lang/set/{lang}',[LangController::class, 'set']);

            -we added lang route , that will go to langController to set language
            
            -we applied our lang middleware on routes that have translations

        LangController.php:
            -php artisan make:controller LangController

            public function set($lang, Request $request){
                $acceptedLangs = ['en', 'ar'];
                if(!in_array($lang, $acceptedLangs)){
                    $lang = 'en';
                }
                $request->session()->put("lang", $lang);
                return back();
            }

            -set() method will put lang value in session
            -we should use session() with request object
            -we made sure that the lang entered by user must be within certain language
            or else lang will be en

            -we redirected back to the route before clicking on button

        Lang.php (middleware):
            -php artisan make:middleware Lang    

            public function handle(Request $request, Closure $next)
            {
                //set App Locale
                $lang = $request->session()->get("lang");
                $lang = $lang ?? 'en'; 

                App::setLocale($lang );

                return $next($request);
            }

            -we  made lang middleware to set locale to a certain language
            -if lang is null ,language will be en (we made this condition for user who open website for first time and no language is set)
            
            -if lang is not null , get value of lang
            - ?? called null concealator operator
            -proceed to next request/route
        kernel.php:
            protected $routeMiddleware = [
                'lang' =>   \App\Http\Middleware\Lang::class,
                //
            ];

            -we put our middleware in $routeMiddleware to be applied on certain routes not all routes 
*/