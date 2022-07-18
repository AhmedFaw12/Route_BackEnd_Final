<?php
/*
navbar x-component:
    in HomeController:
        public function index(){
            $data['cats'] = Cat::select("id", "name")->get();

            return view("web.home.index")->with("data", $data);
        }
    -this categories data will be sent only to index blade 
    -if we go to any pages ,there will be no data in navbar(layout blade)
    
    -so we can't send categories to index blade only
    -we should also do this line :  $data['cats'] = Cat::select("id", "name")->get(); in all controllers

    -this will be repeatition of code in many controllers 
    -Solution:
        -we use x-components
        -its idea is that when something like navbar needs to get data from database and this navbar is used in many pages
        -so instead of repeating database code in many controllers 
        -we will seperate this navbar in a standalone x-component
        -and when we create the x-component, it comes with class and blade
        -we will fetch data from database in x-component class

        -we can apply this idea to any component the needs data and this components will be used in many pages.

    Example:
        -php artisan make:component Navbar
        -this will creates two files :
            -app/View/Components/Navbar.php:
                public function render()
                {
                    $data['cats'] = Cat::select("id", "name")->get();
                    return view('components.navbar')->with("data",$data);
                }

                -get cat data from database and pass it to navbar component 
                -render() is called automatically
            
            -resources/views/components/navbar.blade.php :
                <!-- Navigation Links -->
                <nav id="nav">
                    <ul class="main-menu nav navbar-nav navbar-right">
                        <li><a href="index.html">@lang('web.home')</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">@lang('web.cats')<span class="caret"></span></a>
                            {{-- cats dropdown --}}
                            <ul class="dropdown-menu">
                                @foreach ($data['cats'] as $cat)
                                    <li><a href="{{url("categories/show/{$cat->id}")}}">
                                    {{$cat->name()}}
                                    </a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="contact.html">@lang('web.contact')</a></li>
                        <li><a href="login.html">@lang('web.signin')</a></li>
                        <li><a href="register.html">@lang('web.signup')</a></li>
                        {{-- switch language --}}
                        @if(App::getLocale() == 'en')
                            <li><a href={{url("/lang/set/ar")}}>ع</a></li>
                        @else
                            <li><a href={{url("/lang/set/en")}}>EN</a></li>
                        @endif
                    </ul>
                </nav>
                <!-- /Navigation Links-->


                -we only took part of navbar (navigation links) from layout.blade.php and put it in navbar.blade.php 

                -here we can use data fetched from database

        
        -layout.blade.php:
            <!-- Navigation Links -->
            <x-navbar></x-navbar>
            <!-- /Navigation Links-->
            
            -to use navbar component we will use html tag (x-navbar)
            
            Note:
                if we created componet with name consists of multiple parts:
                Example:
                    php artisan make:component AlertSuccess

                    -its blade will be : alert-success
                    -to use it as html tag :
                        <x-alert-success>
                        </x-alert-success>
        
        -HomeController.php:
            public function index(){
                return view("web.home.index");
            }            
*/