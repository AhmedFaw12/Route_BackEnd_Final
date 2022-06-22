<?php 
/* 
- filename and class names can be different 
*/
require_once("Shape.php");
class Circle implements Shape{
    
    protected $r;
    function __construct($r)
    {
        $this->r = $r;
    }
    function perimeter(){
        return 2* pi() *$this->r ;
    }

    function area(){
        return pi() * ($this->r **2);
    }

}


class Rect implements Shape{
    //access modifiers
    //var= public, private, protected

    //instance- class members - properties
    // public $length;
    // public $width;
    protected $length;
    protected $width;

    //constuctor initializations
    public function __construct($length, $width=null){
        
        if(empty($width)){
            $this->width = $length;
        }else{
            $this->width = $width;
        }
        $this->length = $length;
    }
    //instance functions
    public function area(){
        //this == currenct object(currenct instance)
        return $this->length * $this->width;
    }

    public function perimeter(){
        return 2*($this->width + $this->length);
    }

    //public getters and setters - private members - encapsulation concept
    public function get_length(){
        return $this->length;
    }
    public function get_width(){
        return $this->width;
    }
    public function set_length($length){
        $this->width = $length;
    }
    public function set_width($width){
        $this->width = $width;
    }
}

class Box extends Rect implements ThreeD{
    protected $height;

    //constructor override
    function __construct($length, $width, $height){
        parent::__construct($length, $width);// calling old constructor
        $this->height = $height;
    }

    //override
    function area(){
        // SA=2lw+2lh+2hw = 2(l*w + l*h + h*w)
        return 2*(parent::area() + $this->length* $this->height + $this->width * $this->height);
    }

    function volume(){
        return $this->height * parent::area(); //H * L * W
    }
}