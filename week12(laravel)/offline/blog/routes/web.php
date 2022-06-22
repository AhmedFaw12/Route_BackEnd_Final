<?php

use App\Http\Controllers\CalcController;
use App\Http\Controllers\TestController;
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

Route::get('/', function () {
    return view('welcome');
});

//print hello when writing /test in the route
// Route::get('/test', function () {
//     echo "Hello <br>";
// });


// Route::get('/test/{name}', function ($name) {
//     echo "Hello $name <br>";
// });

//print optional name
Route::get('/test/{name?}', function ($name = null) {
    echo "Hello $name <br>";
}); //->where("name", "[a-zA-Z]*");

//execute function in controller class
Route::get('/test2', [TestController::class, "test"]);

//pass by location
// Route::get('/sum/{n1}/{n2?}', [CalcController::class, "sum"])->where("n1", "[0-9]+");
Route::get('/sum/{n1}/{n2?}', [CalcController::class, "sum"])->whereNumber("n1");

//Receive parameters by request object
Route::get('/sum2/{n1}/{n2?}', [CalcController::class, "sum2"]);

//Encoded Forward Slashes
Route::get("/search/{search}", [CalcController::class, "search"])->where("search", ".*"); //. means any character

//view example 1
Route::get("/welcome/{name}", [TestController::class, "welcome"]);
Route::get("/demo", [TestController::class, "demo"]);
