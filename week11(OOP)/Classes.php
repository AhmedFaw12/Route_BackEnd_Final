<?php
//Aggregation example
//project has students and supervisor
//project,students, supervisor can exist separately
abstract class Person{
    public $name;
    function __construct($name){
        $this->name = $name;
    }
}

class Student extends Person{
    public $grade;
    public $creditHours;
}

class Doctor extends Person{

}

//project has students and supervisor
class Project{
    //we can determine type of properties
    public $students =[];
    public Doctor $supervisor;

    function __construct(){

    }

   function add_student(){

   }


}

$proj1 = new Project();
$proj1->student[] = new Student("ahmed");
$proj1->student[] = new Student("dina");
$proj1->supervisor = new Doctor("Ali");

