<?php
/*
Website assets:
    public Folder:
        -we will put assets in public,but we will need to divide our public in a good way
        -so we will make 3 folders: 
            -web : 
                -for website assets(frontEnd Contents Folder/skillshub)
                -we will take css, js , fonts, some of imgs
                -img :some will be put in public(logo.png, ...) , and some will be put in upload folder at first , then we will move them to storage

            -admin : 
                -for dashboard assets(frontEnd Contents Folder/adminlte-basic)

            -upload:
                -we will make skills, Exams folders 
                -we will take exam, skills imgs from frontEnd Contents Folder/skillshub/img       
------------------------------------------------------------------------------------------------------------------------------------------------------------------

Routes:
    Home Page:
        -we need to make route to display home page
        -Example:
            web.php:
                -we made a route to index() in  Web/HomeController
                Route::get('/',[HomeController::class, 'index']);

            Http/Controllers/Web/HomeController:
                -we made a controller in Web folder :php artisan make:controller Web/HomeController
                -we made 

                class HomeController extends Controller
                {
                    public function index(){
                        return view("web.home.index");
                    }
                }  
            
            web/home/index.blade.php:
                we made Web folder to hold blade of (frontend Contents/skillshub) 
                -we made index blade to display home page(frontend Contents/skillshub/index.html)

                -page is not working properly because of paths , ....

                -there is some code that is common between multiple pages in Web folder(taken from frontend Contents/skillshub) so we will make a layout to hold common code

                -index.blade will extends layout: @extends("web.layout").
                -index.blade will add its title: 
                    @section("title")
                        Homepage
                    @endsection
                
                -index.blade will override main section :
                    @section("main")
                        //code
                    @endsection


                -we need to adjust static imgs path:
                    <div class="bg-image bg-parallax overlay" style="background-image:url({{asset('web/img/home-background.jpg')}})"></div>

                    <div class="bg-image bg-parallax overlay" style="background-image:url({{asset('web/img/cta.jpg')}})"></div>

                -we need to adjust dynamic imgs path(in upload folder):
                    <img src={{asset("uploads/exams/exam1.jpg")}} alt="">
                    <img src={{asset("uploads/exams/exam2.jpg")}} alt="">
                    <img src={{asset("uploads/exams/exam3.jpg")}} alt="">
                    <img src={{asset("uploads/exams/exam4.jpg")}} alt="">
                    <img src={{asset("uploads/exams/exam5.jpg")}} alt="">
                    <img src={{asset("uploads/exams/exam6.jpg")}} alt="">
                    <img src={{asset("uploads/exams/exam7.jpg")}} alt="">
                    <img src={{asset("uploads/exams/exam8.jpg")}} alt="">
            web/layout.blade.php:
                -it will contain head tag, header section , footer section , scripts 

                change title to skillshub and add @yield("title") , so that each page will add its title:
                    <title>SkillsHub - @yield('title')</title>
                
                -below css links ,we will add another @yield("styles"), incase some page wants to add more styles
                
                -we will add @yield("main") between header and footer
                -below scripts , we will add @yield("scripts") incase some page wants to add more scripts


                we need to adjust css links:
                    <!-- Bootstrap -->
                    <link type="text/css" rel="stylesheet" href={{asset("web/css/bootstrap.min.css") }} />

                    <!-- Font Awesome Icon -->
                    <link rel="stylesheet" href={{asset("web/css/font-awesome.min.css") }}>

                    <!-- Custom stlylesheet -->
                    <link type="text/css" rel="stylesheet" href={{asset("web/css/style.css") }} />

                -we need to adjust js links:
                    <script type="text/javascript" src={{asset("web/js/jquery.min.js") }}></script>
                    <script type="text/javascript" src={{asset("web/js/bootstrap.min.js") }}></script>
                    <script type="text/javascript" src={{asset("web/js/main.js") }}></script>

                -we need to adjust static imgs path:
                    <img src={{asset("web/img/logo.png")}} alt="logo">
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    -we need to add other pages
    Category Page:
        Example:
            web.php:
                Route::get('/categories/show/{id}',[CatController::class, 'show']);
                
                -we will use show method to show category by id
                -because (index)show all categories has no page , we will just show all categories in dropdown menu in navbar
            CatController:
                -To make controller : php artisan make:controller Web/CatController
                -we will make show method

                class CatController extends Controller
                {
                    public function show($id){
                        return view("web.cats.show");
                    }
                }
            Views/web/cat/show.blade.php:
                @extends('web.layout');
                @section('title')
                    Show category:
                @endsection
                @section('main')
                    //copy frontend Contents/skillshub/category.html main sections only
                @endsection

                adjust imgs :
                    -same way as in index blade
                
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Skills page:
        web.php:
            Route::get('/skills/show/{id}',[SkillController::class, 'show']);
        Web/SkillController:
            -php artisan make:controller Web/SkillController
             public function show($id){
                return view("web.skills.show");
            }

        views/web/exams/show.blade.php:
            @extends('web.layout')

            @section('title')
                Show Skill :
            @endsection

            @section('main')
                //copy frontend Contents/skillshub/skill.html main sections only
            @endsection
            -adjust img paths
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    Exam page & Questions Page
        
        web.php:
            Route::get('/exams/show/{id}',[ExamController::class, 'show']);
            Route::get('/exams/questions/{id}',[ExamController::class, 'questions']);

        Web/ExamController:
            -php artisan make:controller Web/ExamController
            -we will make both functions in one controller
            
            public function show($id){
                return view("web.exams.show");
            }

            public function questions($id){
                return view("web.exams.questions");
            }
        
        views/web/exams/show.blade.php:
            @extends('web.layout')

            @section('title')
                Show Exam :
            @endsection

            @section('main')
                //copy frontend Contents/skillshub/exam.html main sections only
            @endsection
            -adjust img paths
        views/web/exams/questions.blade.php:
            @extends('web.layout')

            @section('title')
                Exam Questions :
            @endsection

            @section('main')
                //copy frontend Contents/skillshub/exam-questions.html main sections only
            @endsection

            -adjust img paths
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/