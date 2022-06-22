<?php 

/*
Introdution: 

-Class is considered a (BluePrint)(رسم تخطيطى مفيهوش داتا )

-Classes are the blueprints for php objects - more on that later. One of the big differences between functions and classes is that a class contains both data (variables) and functions that form a package called an: 'object'. 


-Class consists of : 
    1)properties(fields)(or instance members) : 
        ex:name, email, mobile, password, role
         
    2)functions(or actions)(or methods):
        ex:login(), register(), create_admin(), logout(), make_order(),...

- we make object(or instance) from class
- class itself does not take/consume any memory.
- object exists in(consume) memory

-OOP has multiple concepts(inheritance, polymerphism, abstraction, ...)

- filename and class names can be different 

-The data/variables inside a class (ex: var $name;) are called 'properties'.

-To declare function :ex:public function area(){}

-we can make object in the same file or another file(but use require_once(class_filename))


////////////////////////////////////////////////////////////////
-->this:
    - To access members inside class , we use word ($this->member name)

    -this == currenct object(currenct instance that will be created )

-->access modifiers:
    -data inside class can be declared using:
        - var or public, private, protected
        -ex:
            -public $x, $y; 
            - or public $x;
            -public $y

    -public :can be accessed from inside or outside class.This is default
    -private : can be accessed from inside class only(objects can not access private properties)
    -protected : the property or method can be accessed within the class and by classes derived from that class
    -friend  :not in php
    -default : not in php

-->new :
    -To create object(instance) from class use word(new):
    $r1 = new Rect();

-->object Storage in Memory:
    -memory is divided into stack and heap 
    -$r1 is stored in stack
    -objects , arrays is stored in heap
    -$r1 reference object
    -php initialize variable with null

-->arrow operator:
    we use arrow operator to access memebers , fucntions

-->constructor:
    -it is called automatically when instantiating object

    -The 'construct' method starts with two underscores (__) and the word 'construct'.
    
    -syntax:
    public function __construct($length, $width){
        $this->length = $length;
        $this->width = $width;
    }

    -if we did not make constructor ,empty (default) constructor is defined by default. 

-->constuctor overload(زيادة)(by using default args):
    -in other language overload is done by repeating constructor itself with different arguments, but in PHP we 
    use only default args.

    -we can make default arguments in constructor:example:
    public function __construct($length, $width=null){
        
        if(empty($width)){
            $this->width = $length;
        }else{
            $this->width = $width;
        }
        $this->length = $length;
    }

    -we can also make overload to functions inside class using default args

    -default args should be put at the end

-->constructor override:
    - in child class , replace old constructor
    example:
    class Rect{
        protected $length;
        protected $width;

        //constuctor
        public function __construct($length, $width=null){    
            if(empty($width)){
                $this->width = $length;
            }else{
                $this->width = $width;
            }
            $this->length = $length;
        }
    }
    -in php , if child class has not constructor, it will call parent constructor

    - in php , if we made constructor in child class , parent constructor will not be called by default , untill I call it 

    - in java ,if we made constructor in child class , parent default constructor will be called by default  , (so both child constructor + parent default constructor will be called)
        
    class Box extends Rect{
        protected $height;

        //constructor override
        function __construct($width, $length, $height){
            parent::__construct($width,$length);
            $this->height = $height;
        }
    }

-->Encapsulation(1st oop concept):
    - making members private , we can make setters or getters or both to access these members.

-->getters and setters: are (public)functions to access(read, write) private members

*/
