<?php
/*
-->Abstraction(نبذة مختصرة او مجردة):
    Abstract classes and methods are when the parent class has a named empty method, but need its child class(es) to fill out the tasks(to write the method).

    -An abstract class is a class that contains at least one abstract method. An abstract method is a method that is declared, but not implemented in the code.

    -An abstract class or method is defined with the abstract keyword:

    Syntax:
    abstract class ParentClass {
        abstract public function someMethod1();
        abstract public function someMethod2($name, $color);
        abstract public function someMethod3() : string;
    }

    -We can't create objects from abstract class

    -So, when a child class is inherited from an abstract class, we have the following rules:

        -The child class method must be defined with the same name and it redeclares the parent abstract method
        
        -The child class method must be defined with the same or a less restricted access modifier. So, if the abstract method is defined as protected, the child class method must be defined as either protected or public, but not private.

        The number of required arguments must be the same. However, the child class may have optional arguments in addition

        example:
        // Parent class
        abstract class Car {
            public $name;
            public function __construct($name) {
                $this->name = $name;
            }
            abstract public function intro() : string;
        }

        // Child classes
        class Audi extends Car {
            public function intro() : string {
                return "Choose German quality! I'm an $this->name!";
            }
        }

    - abstraction in C# is called :Must Override

    - we can make abstract class with no abstract method , to prevent taking object from the abstract class

    -abstract class has other name such as (Must Override), (Must Inherit)
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


-->Interface:
    -Interfaces allow you to specify what methods a class should implement.

    -Interfaces make it easy to use a variety of different classes in the same way. When one or more classes use the same interface, it is referred to as "polymorphism".

    -Interfaces are declared with the interface keyword:

    -To implement an interface, a class must use the implements keyword.

    -Interfaces vs. Abstract Classes:
        Interface are similar to abstract classes. The difference between interfaces and abstract classes are:

            -Interfaces cannot have properties, while abstract classes can

            -All interface methods must be public, while abstract class methods is public or protected

            -All methods in an interface are abstract(Pure Abstract), so they cannot be implemented in code and the abstract keyword is not necessary
            
            -Classes can implement an interface while inheriting from another class at the same time

            -Class can implement multiple interfaces and inherit one class only
			
			-Interface can not contain constructor , while abstract class can
			
			-Interface can not inherit from class , but can inherit from multiple interfaces using word extends
			
			-Interface cannot have properties but can have constants
            
    example1 :
        interface FollowCustomers{
            //public abstract
            function follow();
            function order();
        }
        interface Buyer{
            function buy();
        }

        class Sales extends Employee implements FollowCustomers, Buyer{
            function follow(){
                echo "Can Follow Customers";
            }

            function order(){
                echo "Can Make Customer Order";
            }
            
            function buy(){
                echo "Can buy products";
            }
        }

    -interface class inherit from multiple interfaces :
    example2:
        interface FollowCustomers{
            //public abstract
            function follow();
            function order();
        }

        interface Buyer{
            function buy();
        }

        interface Test extends FollowCustomers, Buyer{

        }
    

    -we can't make objects directly from interface (as interface is pure abstract), but i can make object from class that implements interface
    
	-we can make method that takes parent object(maybe abstract or even interface),but we can not send objects from interface or abstract, but we can send any object from child of parent 
    -sending child of interface as a parameter.
    example :
        class Info{
            static function print(Shape $arg){
                echo "Area : " . $arg->area() . "<br>";
                echo "Perimeter : " . $arg->perimeter() . "<br>";
            }
        }

        $c = new Circle(80);
        Info::print($c);
	
	
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

-->Static Methods:
    
    -static method can be called directly without creating an instance of the class first.
    
    -Static methods are declared with the static keyword:

    -example:
        class Info{
            static function print(Shape $arg){
                echo "Area : " . $arg->area() . "<br>";
                echo "Perimeter : " . $arg->perimeter() . "<br>";
            }
        }
    
    -To access a static method use the class name, double colon(resolution operator) (::), and the method name:
        ClassName::staticMethod();
        example:
            $c = new Circle(80);
            Info::print($c);
    
    -A class can have both static and non-static methods. A static method can be accessed from a method in the same class using the self keyword and double colon (::):
        example :
        class greeting {
            public static function welcome() {
                echo "Hello World!";
            }
            public function __construct() {
                self::welcome();
            }
        }

        $g = new greeting();
    
    -Static methods can also be called from methods in other classes. To do this, the static method should be public:
    class greeting {
        public static function welcome() {
            echo "Hello World!";
        }
    }

    class SomeOtherClass {
        public function message() {
            greeting::welcome();
        }
    }

    -To call a static method from a child class, use the parent keyword inside the child class. Here, the static method can be public or protected.

    class domain {
        protected static function getWebsiteName() {
            return "W3Schools.com";
        }
    }

    class domainW3 extends domain {
        public $websiteName;
        public function __construct() {
            $this->websiteName = parent::getWebsiteName();
        }
    }

    $domainW3 = new domainW3();
    echo $domainW3 -> websiteName;
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

-->Static Properties :
    -Static properties can be called directly - without creating an instance of a class.

    -Static properties are declared with the static keyword

    -same as static methods

    example :
    class Info{
        public static $PI = 22/7;
    }

    -can't use const with static 
    -since there is no const , i can change in static variable:
    Info::$PI = 50;
    echo Info::$PI;

    -we can use const instead of static , if we want unchangable value , and it will also be accessed by 
    ClassName ::constant_name:
    -const is static by default

    example :
    class Info{
        public const PI = 22/7;
        public static $counter ;
    }

    echo Info::PI;
    Info::$counter = 1;
    echo Info::$counter;
    Info::$counter++;
    echo Info::$counter;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

*/
?>