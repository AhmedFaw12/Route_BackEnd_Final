<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;

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

//display master view
// Route::get('/', function () {
//     return view('master');
// });

Route::get('/', function () {
    return view('welcome');
});

// Route::get("/depts", [DepartmentController::class,"index"]);
// Route::get("/depts/store", [DepartmentController::class,"store"]);
// Route::get("/depts/{department}", [DepartmentController::class,"show"]);
// Route::get("/depts/{department}/delete", [DepartmentController::class,"destroy"]);

//example for route::resource
Route::resource('department', DepartmentController::class);

