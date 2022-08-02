<?php  

// class Calculator{
//     public function calculate($x, $y, $op){
//         if($op == 'add'){
//             return $x + $y;
//         }elseif($op == 'sub'){
//             return $x - $y;
//         }elseif($op == 'mul'){
//             return $x * $y;
//         }elseif($op == 'div'){
//             return $x / $y;
//         }
//     }
// }
class Calculator{
    public function calculate($x, $y,Operation $op){
        return $op->calculate($x, $y);
    }
}

interface Operation{
    public function calculate($x, $y);
}

class Add implements Operation{
    public function calculate($x, $y){
        return $x + $y;
    }
}
class Sub implements Operation{
    public function calculate($x, $y){
        return $x - $y;
    }
}
class Mul implements Operation{
    public function calculate($x, $y){
        return $x * $y;
    }
}
class Div implements Operation{
    public function calculate($x, $y){
        return $x / $y;
    }
}

// $calc = new Calculator;
// echo $calc->calculate(3, 4,'+');

$calc = new Calculator;
echo $calc->calculate(3, 4, new Add);



?>