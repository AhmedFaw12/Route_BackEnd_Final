<?php

//shape has no properties , only methods then we make it interface not class
interface Shape{
    function perimeter();
    function area();
    // define datatype Shape
    // function print_info(Shape $shape);
}

interface ThreeD{
    function volume();
}

//static function
//static method can be called directly without creating an instance of the class first.
class Info{
    public const PI = 22/7;
    public static $counter ;


    static function print(Shape $arg){
        echo "Area : " . $arg->area() . "<br>";
        echo "Perimeter : " . $arg->perimeter() . "<br>";
    }


}