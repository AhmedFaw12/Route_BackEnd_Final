<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Support\Facades\DB;

class TestController extends Controller{
    function test(){
        echo "Hello From Controller <br>";
    }

    function welcome($name){
        // return view("show")->with("name", $name);
        return view("show", ["name"=>$name]);
    }

    function demo(){
        // $rslt = DB::select("select * from regions");
        // $rslt = DB::table("regions")->get();

        //using model
        $rslt = Region::get();
        // $rslt = Region::find(10);

        dump($rslt);
    }
}
