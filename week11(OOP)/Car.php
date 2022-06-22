<?php
// example on composition(Car composed of engine )
//trait is same as class , but it is not used alone , it is used inside another class
//trait is not always used with composition
trait Engine{
    public $power;
    public $manufacturer;
}

class Car{
    use Engine;
    public $color;
    public $model;
}

class Test{
    use Engine;
}

$c1 = new car();
$c1->color = "red";
$c1->model = "BMW1228";
$c1->power = 1554;
$c1->manufacturer = "XX";
