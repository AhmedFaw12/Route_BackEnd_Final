<?php 
require_once("User.php");
//inheritance
//User is called parent(or super or base) class
//Employee is called Child(or sub) class

abstract class Employee extends User{
    public $salary, $job_title;    

    function __construct()
    {   
        echo "<br>Employee Created<br>";
    }

    //override -polymerphism(تعدد الأشكال)
    function profile(){

        return parent::profile() . "<br>salary : ". $this->salary. "<br>Job Title : ". $this->job_title;
    }

    abstract function net_salary();
}


class Sales extends Employee implements FollowCustomers{
    public $collection;
    public $target;
    public $ratio;

    function __construct()
    {   
        //parent will get direct parent
        // parent::__construct();
        // User::__construct(); //class name will get one of grandparents
        echo "<br>Sales Created<br>";
    }

    function net_salary(){
        if($this->collection >= $this->target){
            return $this->salary + ($this->collection * $this->ratio);
        }else{
            return $this->salary;
        }
    }

    function follow(){
        echo "Can Follow Customers";
    }

    function order(){
        echo "Can Make Customer Order";
    }
}

class Instructor extends Employee{
    public $hours;
    public $hour_price;

    function net_salary(){
        return $this->salary + ($this->hours * $this->hour_price);
    }
}

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

