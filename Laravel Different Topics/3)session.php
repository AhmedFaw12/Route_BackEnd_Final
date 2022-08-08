<!-- 
session():
    -session is used with request
    $request->session()->put(): 
        -to put value in session
        example:
            $request->session()->put('x', 3);
            -put x = 3 in session 

    
    $request->session()->flash(): 

        -store items in the session for the next request only. You may do so using the flash method. 
        
        -Data stored in the session using this method will be available immediately and during the subsequent HTTP request.
        
        -After the subsequent(لاحق) HTTP request, the flashed data will be deleted. Flash data is primarily useful for short-lived status messages:
            

        Example:
            $request->session()->flash('x', 3);
            -put x = 3 in session 

    -$request->session()->get(): 
        -to get value from session
        Example:
            $request->session()->get('x');

    -$request->session()->forget(): 
        -to delete value from session
        Example:
            $request->session()->forget('x')
    
Example on Session:
    AuthController.php:
        public function register(Request $request){
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'password' => 'required|string|min:5|max:30|confirmed',
            ]);

            $data["password"] = bcrypt($data["password"]);
            $user = User::create($data);
            Auth::login($user);

            $request->session()->flash("success_msg", "user Registered successfully");

            return redirect(url('/home'));
        }

        -after user registered successfully , put/flash in session success msg
    
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

            $request->session()->flash("success_msg", "user logged in successfully");
            return redirect(url('/home'));
        }

        -after user logged in successfully , put/flash in session success msg
    
    messages.blade.php:
        @if(request()->session()->get("success_msg"))
            <div class="alert alert-success">
                <p>{{request()->session()->get("success_msg")}}</p>
            </div>
        @endif

        -To use session ,we will use request() helper method


        @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
        @endif
    

    home.blade.php:
        @include('inc.messages')

        
 -->