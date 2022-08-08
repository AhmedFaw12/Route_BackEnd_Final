<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm(){
        return view("auth.register");
    }

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

        $request->session()->flash("success_msg", "user logged in successfully");
        return redirect(url('/home'));
    }


    public function logout(){
        Auth::logout();
        return redirect(url('/login'));
    }
}
