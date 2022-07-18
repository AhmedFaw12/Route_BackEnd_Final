<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => "required|string|max:255",
            'email' => "required|email|max:255",
            'password' => "required|string|min:5|max:25|confirmed",
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $studentRole = Role::where('name', 'student')->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' =>$studentRole->id,
        ]);

        $token = $user->createToken("auth-token");

        return ['token'  => $token->plainTextToken];
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => "required|email|max:255",
            'password' => "required|string|min:5|max:25",
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $credentials = $request->only('email', "password");
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken("auth-token");

            return ["token", $token->plainTextToken];
        }else{
            return response()->json(['invalid' =>"Invalid Email or Password"]);
        }
    }
}
