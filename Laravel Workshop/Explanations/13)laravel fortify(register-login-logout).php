<!--
Laravel fortify:
    Introduction:
        -Laravel Fortify is a frontend agnostic authentication backend implementation for Laravel. Fortify registers the routes and controllers needed to implement all of Laravel's authentication features, including login, registration, password reset, email verification, and more. After installing Fortify, you may run the route:list Artisan command to see the routes that Fortify has registered.

        -Since Fortify does not provide its own user interface(UI), it is meant to be paired with your own user interface which makes requests to the routes it registers. We will discuss exactly how to make requests to these routes in the remainder of this documentation.
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Installation:
        Commands:
            -composer require laravel/fortify
            -php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
            -php artisan migrate

            -The vendor:publish command discussed above will also publish the App\Providers\FortifyServiceProvider class. You should ensure this class is registered within the providers array of your application's config/app.php configuration file.

        Explanation:
            -composer require laravel/fortify:
                install/download Fortify using the Composer package manager
            
            -php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider":
                -publish Fortify's resources using the vendor:publish command
                
                -This command will publish Fortify's actions to your app/Actions directory, which will be created if it does not exist. In addition, the FortifyServiceProvider, configuration file, and all necessary database migrations will be published.
            
            -php artisan migrate:
                you should migrate your database:

            -The Fortify Service Provider:
                The vendor:publish command discussed above will also publish the App\Providers\FortifyServiceProvider class. You should ensure this class is registered within the providers array of your application's config/app.php configuration file.

                example:
                    config/app.php:
                        providers => [
                            //
                            App\Providers\FortifyServiceProvider::class,
                            //
                        ]
    -------------------------------------------------------------------------------------
    -------------------------------------------------------------------------------------


    Register:
        -Laravel Fortify will handle backend , we will only make frontend form, register, ....
        
        views/auth/register.blade.php:
            @extends('web.layout')

            @section('title')
                Sign Up
            @endsection

            @section('main')
                # Hero-area #
                <div class="hero-area section">
                    # Backgound Image #
                    <div class="bg-image bg-parallax overlay" style="background-image:url({{asset('web/img/home-background.jpg')}})"></div>
                    # /Backgound Image #

                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1 text-center">
                                <ul class="hero-area-tree">
                                    <li><a href="index.html">{{__('web.home')}}</a></li>
                                    <li>{{__('web.signup')}}</li>
                                </ul>
                                <h1 class="white-text">{{__('web.signup')}} {{__("web.and estimate your skills")}}</h1>

                            </div>
                        </div>
                    </div>
                </div>
                # /Hero-area #
                # Contact #
                <div id="contact" class="section">
                    # container #
                    <div class="container">

                        # row #
                        <div class="row">

                            # login form #
                            <div class="col-md-6 col-md-offset-3">
                                <div class="contact-form">
                                    <h4>{{__('web.signup')}}</h4>
                                    
                                    @include('web.inc.messages')

                                    <form action="{{url('/register')}}" method="POST">
                                        @csrf
                                        <input class="input" type="text" name="name" placeholder="Name">
                                        <input class="input" type="email" name="email" placeholder="{{__('web.email')}}">
                                        <input class="input" type="password" name="password" placeholder="{{__('web.pass')}}">
                                        <input class="input" type="password" name="password_confirmation"
                                            placeholder="{{__('web.confirm-pass')}}">
                                        <button type="submit" class="main-button icon-button pull-right">{{__('web.signup')}}</button>
                                    </form>
                                </div>
                            </div>
                            # /login form #

                        </div>
                        # /row #

                    </div>
                    # /container #
                </div>
                # /Contact #
            @endsection


            -we copied register.html to register.blade.php
            -we added some translations
            -we adjust image background

            -translations will not work as lang middleware is not applied on fortify added routes
            -we will see later how to apply lang middleware on routes that we don't see

            -we also add form action , method 
            -we also added @csrf token

            -@include('web.inc.messages') : to get error messages
        ----------------------------------------------------------------------------------------------------------------------------------------------------------------


        -config/fortify:
            -fortify package added many routes , they are not in web.php
            -we can see these routes using :php artisan route:list
            -php artisan route:list -> will get us all routes in our application
            -we can disable some features in fortify to reduce some routes:
            
            
            'features' => [
                Features::registration(),
                // Features::resetPasswords(),
                // // Features::emailVerification(),
                // Features::updateProfileInformation(),
                // Features::updatePasswords(),
                // Features::twoFactorAuthentication([
                //     'confirm' => true,
                //     'confirmPassword' => true,
                //     // 'window' => 0,
                // ]),
            ],

            -we disabled some features by commenting them , we left 
            -we only left 2 register routes (get, post) 
         
        ----------------------------------------------------------------------------------------------------------------------------------------------------------------


        -providers/fortifyServiceProvider.php:
            public function boot()
            {
                Fortify::registerView(function () {
                    return view('auth.register');
                });
                
                //Fortify::loginView(function () {
                  //  return view('auth.login');
                //});
            }

            -we must tell fortify about the register view we used 
        ----------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        app/Actions/fortify/CreateNewUser.php:
            
            public function create(array $input)
            {
                Validator::make($input, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => [
                        'required',
                        'string',
                        'email',
                        'max:255',
                        Rule::unique(User::class),
                    ],
                    'password' => $this->passwordRules(),
                ])->validate();

                
                //we will get student role
                $studentRole = Role::where("name", "student")->first();

                return User::create([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'password' => Hash::make($input['password']),
                    'role_id' =>$studentRole->id,
                ]);
            }

            -when we register , fortify call CreateNewUser.php to create the new user
            -it first validates inputs
            -then it create user

            -we can add new elements to be created like role_id

            -we want the registered user to be student :
                $studentRole = Role::where("name", "student")->first();
                return User::create([
                    //
                    'role_id' =>$studentRole->id,
                ])         
        ----------------------------------------------------------------------------------------------------------------------------------------------------------------

        config/fortify.php:
            //'home' => RouteServiceProvider::HOME
            
            //'home' => url("/"),
            
            'home' => "/",

            -by default , when we register or login , fortify go to home page
            -but we don't have home page , so we replace it with any page

            'home' => url("/") : we can't write url() or asset() in any config file , or it will give error

            -another solution :
                -'home' => RouteServiceProvider::HOME  -> leave as it is
                -go to RouteServiceProvider.php : public const HOME = '/';
    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    Logout:     
        views/components/navbar.blade.php:
            OLD_CODE: 
                <li><a href="{{url("/login")}}">@lang('web.signin')</a></li>
                <li><a href="{{url("/register")}}">@lang('web.signup')</a></li>
                <form action="{{url("/logout")}}" method="POST">
                    @csrf
                    <input type="submit" value="{{__("web.signout")}}">
                </form>

                -logout is post request , so we need to put it in a form
                -but since we did not put submit button in a list , design has been corrupted

                -so we will make our form at top of page and give it display:none

                -then make list item with a link that go to nothing
                -and we will make javascript code so that when we click on the link , prevent its default behaviour and submit the form instead

                -we will put javascript code in the footer which exists in the layout page

            Final_CODE:
                
            <nav id="nav">
                <form id="logout-form" action="{{url("/logout")}}" method="POST" style="display:none;">
                    @csrf
                </form>
                //
                @guest
                    <li><a href="{{url("/login")}}">@lang('web.signin')</a></li>
                    <li><a href="{{url("/register")}}">@lang('web.signup')</a></li>
                @endguest
                @auth
                    <li><a id="logout-link" href="#">{{__("web.signout")}}</a></li>
                @endauth

                //
            </nav>

            -so we will make our form at top of page and give it display:none
            -then make list item with a link that go to nothing
            
            -we also made that login, register  links appear when no user log in or register by using @guest directive

            -we also made that logout link appear when there is a user registered or log in
        
        layout.blade.php:
            <script>
                $('#logout-link').click(function(e){
                    e.preventDefault();
                    $('#logout-form').submit()
                });
            </script>

            - we will make javascript code so that when we click on the link , prevent its default behaviour and submit the form instead

            -we will put javascript code in the footer which exists in the layout page
    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    login:
        views/auth/login.blade.php:
            @extends('web.layout')

            @section('title')
                Sign In
            @endsection

            @section('main')
                # Hero-area #
                <div class="hero-area section">

                    # Backgound Image #
                    <div class="bg-image bg-parallax overlay" style="background-image:url({{asset('web/img/home-background.jpg')}})"></div>
                    # /Backgound Image #

                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1 text-center">
                                <ul class="hero-area-tree">
                                    <li><a href="{{url("/")}}">{{__('web.home')}}</a></li>
                                    <li>{{__('web.signin')}}</li>
                                </ul>
                                <h1 class="white-text">{{__('web.signin')}} {{__("web.to start exam")}}</h1>

                            </div>
                        </div>
                    </div>

                </div>
            # /Hero-area #

            # Contact #
            <div id="contact" class="section">
                # container #
                <div class="container">

                    # row #
                    <div class="row">

                        # login form #
                        <div class="col-md-6 col-md-offset-3">
                            <div class="contact-form">
                                
                                @include('web.inc.messages')

                                <h4>{{__('web.signin')}}</h4>
                                <form action="{{url("/login")}}" method="POST">
                                    @csrf
                                    <input class="input" type="email" name="email" placeholder="{{__('web.email')}}">
                                    <input class="input" type="password" name="password" placeholder="{{__('web.pass')}}">

                                    <input type="checkbox" name = "remember"> {{__('web.rememberMe')}}

                                    <button type="submit" class="main-button icon-button pull-right">{{__('web.signin')}}</button>
                                </form>
                            </div>
                        </div>
                        # /login form #

                    </div>
                    # /row #

                </div>
                # /container #
            </div>
            # /Contact #
            @endsection
            
            -we copied login.html to login.blade.php
            -we added translations
            
            -@include('web.inc.messages') : to display errors
            -we added method and action to form
            
            
            -we added boolean field(checked or not checked) remember for the remember me 

            -Fortify can make remember me by only making input checkbox with name remember

            -fortify added remember token to users Table
            -remember me token was null

            -when we activated remember me ,fortifty save remember token in database, then sends to browser cookie that holds this remember token value 

            -remember token value is hashed
    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    Remember Me:
         -we added boolean field(checked or not checked) remember for the remember me 

        -Fortify can make remember me by only making input checkbox with name remember

        -fortify added remember token to users Table
        -remember me token was null

        -when we activated remember me ,fortifty save remember token in database, then sends to browser cookie that holds this remember token value 

        -remember token value is hashed
    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    How to Add middlewares to fortify routes:
        vendor/laravel/fortify/routes/routes.php:
            Route::get('/register', [RegisteredUserController::class, 'create'])
            ->middleware(['guest:'.config('fortify.guard'), 'lang'])
            ->name('register');

            Route::get('/login', [AuthenticatedSessionController::class, 'create'])
            ->middleware(['guest:'.config('fortify.guard'), 'lang'])
            ->name('login');

            -we added lang middleware to login, register (get)
            -they already have middleware guest

    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
-->