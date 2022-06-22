<?php


use App\Models\Department;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
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

//example for pagination
Route::view("/cats", "categories.index", ['depts'=>Department::paginate(10)]);

//example for localization (switching language)
Route::get('/test', function(){
    //1st way to change locale
    Config::set("app.locale", 'en');

    //2nd way to change locale
    // App::setLocale("en");

    echo trans("messages.Departments");
    // return view("master");
});

//example2 for localization (switching language)
Route::get('/change/{lang}', function($lang){
    if($lang == "ar"){
        session()->put("lang", "ar");
    }else{
        session()->put("lang", "en");
    }
    return redirect()->back();
});

