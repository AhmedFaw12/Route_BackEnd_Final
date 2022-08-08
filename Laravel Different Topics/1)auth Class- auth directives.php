<!-- 
Authentication: is checking who a user is.
Authorisation :is checking what a user can do.

Authentication:
    Register:
        web.php:
            Route::get("/register", [AuthController::class, 'registerForm']);//To get register form
            Route::post("/register", [AuthController::class, 'register']);//when user register

        AuthController.php:
            public function registerForm(){
                return view("auth.register");
            }

            
            public function register(Request $request){
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email|max:255',
                    'password' => 'required|string|min:5|max:30|confirmed',
                ]);
                

                $data["password"] = bcrypt($data["password"]);
                $user = User::create($data);
                Auth::login($user);

                return redirect(url('/welcome'));
            }

            unique:users,email :to check if email is unique , we will give it name of table(users) and name of the column(email)

            -when we use input name and another input name_confirmation , we can check if their values are identical using confirmed rule:example password , password_confirmation

            -we will hash the password
            -create user in database

            -Auth::login($user):
                -we pass the created user object to it
                -it will save user data in session and we can use it as model
            -we registered and login at same time

            -redirect to welcome view
        
        

        register.blade.php:
            <h1>Register</h1>

            @include("inc.messages")
            
            <form action="{{url('/register')}}" method="POST">
                @csrf
                <input type="text" name="name" placeholder = "name">
                <br>

                <input type="email" name="email" placeholder = "email">
                <br>

                <input type="password" name="password" placeholder = "password">
                <br>

                <input type="password" name="password_confirmation" placeholder = "confirm password">
                <br>

                <input type="submit" value="register">
            </form>

    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Login:
        web.php:
            Route::get("/login", [AuthController::class, 'loginForm']);//to get login form
            Route::post("/login", [AuthController::class, 'login']);//when user login


        AuthController.php:
            public function loginForm(){
                return view("auth.login");
            }

            public function login(Request $request){
                $data = $request->validate([
                    'email' => 'required|email|max:255',
                    'password' => 'required|string|min:5|max:30',
                ]);

                //to see if user exists
                $credentials = $request->only('email', 'password');

                // if(Auth::attempt(['email' => $data[email], 'password' => $data[password]]))

                $isLogin = Auth::attempt($credentials);

                if(! $isLogin){
                    return back()->withErrors([
                        'credentials not correct'
                    ]);
                }

                return redirect(url('/home'));
            }

            -we removed unique:users,email  rule from email rules because email already exists in database
            
            -if user not exists(not login) , then go back (login) with errors
            -if user exists , then go to home page
        
        inc/messages.blade.php:
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
            @endif

            -we displayed all errors

        inc/messages.blade.php:
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
            @endif

            -we displayed all errors

        login.blade.php:
            <h1>Login</h1>
            @include('inc.messages')
            <form action="{{url('/login')}}" method="POST">
                @csrf

                <input type="email" name="email" placeholder = "email">
                <br>

                <input type="password" name="password" placeholder = "password">
                <br>

                <input type="submit" value="login">
            </form>

            
            -we will include messages.blade.php
    ------------------------------------------------------------------------------------
    ------------------------------------------------------------------------------------


    Logout:
        web.php:
            Route::post("/logout", [AuthController::class, 'logout']);

        AuthController:
            public function logout(){
                Auth::logout();
                return redirect(url('/login'));
            }
            -we removed user data from session using Auth::logout()
            -then go to login page

        layout.blade.php:
            <nav>
                <a href="{{url('/register')}}">register</a>
                <a href="{{url('/login')}}">login</a>
                <form action="" method="POST">
                    @csrf
                    <input type="submit" value="logout">
                </form>
            </nav>
            
            -logout is post request so we put it in form
    ------------------------------------------------------------------------------------
    ------------------------------------------------------------------------------------
    ------------------------------------------------------------------------------------


Auth Class:
    Auth::login($user):
        -we pass the created user object to it
        -it will save user data in session and we can use it as model
        -we saved user model in session


    Auth::logout():
        -removes user data from session

    Auth::attempt($credentials):
        -when we want to check if user wants to login exists in database or not
        -if user exists in database , then save this user data(model) in the session
        example:
            $credentials = $request->only('email', 'password');        
            Auth::attempt($credentials);
            -we give it email and password without hashing, it will hash and compare

            -it will return true or false

    -Auth::user():
        -return user data saved in session
        example:
            Auth::user()->name :it will return name of user
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Auth Directives:
    @guest 
    @endguest
        -guest directive : will appear to users who have not for example registered or login
        example:
            @guest
                <a href="{{url('/register')}}">register</a>
                <a href="{{url('/login')}}">login</a>
            @endguest

    @auth
    @endauth
        -auth directive: will appear to users who have registered or login
        example:
            @auth
                <form action="{{url('/logout')}}" method="POST">
                    @csrf
                    <input type="submit" value="logout">
                </form>
            @endauth
-->