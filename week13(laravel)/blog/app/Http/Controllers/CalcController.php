<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalcController extends Controller
{
    function sum($x, $y = 0){
        echo "$x + $y = " .($x + $y);
    }

    //Receive parameters by using request object
    function sum2(Request $request){
        $x = $request->n1;
        $y = (empty($request->n2))?0:$request->n2;
        echo "$x + $y = " .($x + $y);
    }

    function search(Request $request){
        dump($request->search);//to dump a variable’s contents to the browse
    }
}
