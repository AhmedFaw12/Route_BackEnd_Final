<?php
/*
-->Inheritance(2nd OOP concept) : 
    -When a class derives from another class.

    -The child class will inherit all the public and protected properties and methods from the parent class. In addition, it can have its own properties and methods.

    -An inherited class is defined by using the extends keyword.

    -in java also called extends, in c# called : 

    example:
    class Employee extends User{
    
    }
    -User is called parent(or super or base) class
    -Employee is called Child(or sub) class

    -class can inherit only one class

    

-->Inheritance Override(تجاهل):
    -Inherited methods can be overridden by redefining the methods (use the same name) in the child class.

    -default is hiding/shadow parent method and override by child method

    -To get parent method + new method , we use keyword(parent) with the scope resolution operator (::)+method_name 

    -we can also specify , class parent(direct or from antecedents or grandparents or اجداد) name instead of parent , difference between parent and class name is that parent get the direct parent.
    example: User::profile()

    -Inheritance Override is considered part of polymerphism(تعدد الاشكال)

    example:
    class Employee extends User{
    public $salary, $job_title;    

    //override
    function profile(){

        return parent::profile() . "<br>salary : ". $this->salary. "<br>Job Title : ". $this->job_title;
    }
}


-->final keyword: 
    -can be used to prevent class inheritance or to prevent method overriding.

    example to prevent class inheritance:
        final class Fruit {
            // some code
        }

        // will result in error
        class Strawberry extends Fruit {
            // some code
        }

    example  to prevent method overriding:
    class Fruit {
         final public function intro() {
            // some code
        }
    }
        class Strawberry extends Fruit {
        // will result in error
        public function intro() {
            // some code
        }
    }
///////////////////////////////////////////////////////////////////////
polymerphism (3rd oop concept):
    -override 
    -overload(default args)

    
*/