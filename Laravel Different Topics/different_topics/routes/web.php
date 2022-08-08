<?php

use App\Http\Controllers\AuthController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return view('home');
});

Route::middleware(['guest'])->group(function () {
    Route::get("/register", [AuthController::class, 'registerForm']);//To get register form
    Route::post("/register", [AuthController::class, 'register']);//when user register

    Route::get("/login", [AuthController::class, 'loginForm']);//to get login form
    Route::post("/login", [AuthController::class, 'login']);//when user login
});


Route::middleware("auth")->group(function(){
    Route::post("/logout", [AuthController::class, 'logout']);
});
