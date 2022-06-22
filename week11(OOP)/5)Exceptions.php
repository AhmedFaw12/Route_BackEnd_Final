<?php

/*
    -->What is an Exception?
        -An exception is a PHP built-in class that describes an error or unexpected behaviour of a PHP script.

        -Exceptions are thrown by many PHP functions and classes.

        -User defined functions and classes can also throw exceptions.

        -Exceptions are a good way to stop a function when it comes across data that it cannot use.
    
    -->Throwing an Exception:
        -The throw statement allows a user defined function or method to throw an exception. When an exception is thrown, the code following it will not be executed

        -If an exception is not caught(exceptions that are not caught by the compiler but automatically caught and handled by the Java built-in exception handler), a fatal error will occur with an "Uncaught Exception" message.
    
    -->The try...catch Statement :
        -To avoid the error from throw new exception("Division by zero")), we can use the try...catch statement to catch exceptions and continue the process.

        -we can catch exception of my type or parent type(Exception)

        -by using try...catch , no error will be stored in error.log file
    
    -->The Exception Object:
        -The Exception Object contains information about the error or unexpected behaviour that the function encountered

        -Syntax:
        new Exception(message, code, previous)

        parameters:
        message : 	Optional. A string describing why the exception was thrown

        -code : Optional. An integer that can be used used to easily distinguish this exception from others of the same type

        -->Methods:
            -When catching an exception, the following table shows some of the methods that can be used to get information about the exception:
                getMessage() :Returns a string describing why the exception was thrown
                getPrevious() :If this exception was triggered by another one, this method returns the previous exception. If not, then it returns null
                getCode() :Returns the exception code
                getFile() :Returns the full path of the file in which the exception was thrown
                getLine() :Returns the line number of the line of code which threw the exception

    --making my own exception class:
        -To create a custom exception handler you must create a special class with functions that can be called when an exception occurs in PHP. The class must be an extension of the exception class.

        -The custom exception class inherits the properties from PHP's exception class and you can add custom functions to it.
    
    -->Multiple Exceptions:
        -It is possible for a script to use multiple exceptions to check for multiple conditions.

        -It is possible to use several if..else blocks, a switch, or nest multiple exceptions. These exceptions can use different exception classes and return different error messages:

    -->Re-throwing Exceptions:
        -Sometimes, when an exception is thrown, you may wish to handle it differently than the standard way. It is possible to throw an exception a second time within a "catch" block.

        -A script should hide system errors from users. System errors may be important for the coder, but are of no interest to the user. To make things easier for the user you can re-throw the exception with a user friendly message:

    -->Rules for exceptions:
        -Code may be surrounded in a try block, to help catch potential exceptions
        
        -Each try block or "throw" must have at least one corresponding catch block
        
        -Multiple catch blocks can be used to catch different classes of exceptions
        
        -Exceptions can be thrown (or re-thrown) in a catch block within a try block
        try{
            try{

            }catch(exception $e){
                throw new customException($email);
            }
        }catch(customException $e){

        }

        -A simple rule: If you throw something, you have to catch it.

        -If the exception is not caught in its current "try" block, it will search for a catch block on "higher levels".


*/

//example 1 on Exception
// function divide($dividend, $divisor) {
//     if($divisor == 0) {
//       throw new Exception("Division by zero");
//     }
//     return $dividend / $divisor;
// }

// // echo divide(5, 0); //uncaught exception fatal error
// echo divide(5, 1);
// echo "<hr>";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//example 2 on Try Catch
// function divide($dividend, $divisor) {
//     if($divisor == 0) {
//       throw new Exception("Division by zero");
//     }
//     return $dividend / $divisor;
// }
// try {
//     echo divide(5, 0);
// } catch(Exception $e) {
//     echo "Unable to divide.";
// }
// echo "<hr>";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//example 3 
// function divide($dividend, $divisor)
// {
//     if ($divisor == 0) {
//         throw new Exception("Division by zero", 1);
//     }

//     return $dividend / $divisor;
// }

// try {
//     echo divide(5, 0);
// } catch (Exception $ex) {
//     $code = $ex->getCode();
//     $message = $ex->getMessage();
//     $file = $ex->getFile();
//     $line = $ex->getLine();
//     echo "Exception thrown in $file on line $line: [Code $code] $message";
// }
// echo "<hr>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//example4 on Multi catch exception handling
// class MyException extends Exception { }

// class MyOtherException extends Exception { }

// class Test {
//     public function testing() {
//         try {
//             throw new MyException();
//         } catch (MyException | MyOtherException $e) {
//             var_dump(get_class($e));
//         }
//     }
// }

// $foo = new Test;
// $foo->testing(); //o/p : string(11) "MyException"
// echo "<hr>";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//example 5 on creating my Exception
// abstract class Person
// {
//     protected $name;
//     function __constructor($name)
//     {
//         $this->name = $name;
//     }
// }

// class Student extends Person
// {
//     protected $grade;
//     protected $creditHours;
// }

// class Doctor extends Person
// {
// }


// class Project
// {

//     protected $students = [];
//     public Doctor $supervisor;

//     function add_student(Student $student)
//     {
//         if (count($this->students) < 3) {
//             $this->students[] = $student;
//         } else {
//             // throw new Exception("Project Full");
//             throw new ProjectFullException();
//         }
//     }
// }

// class ProjectFullException extends Exception
// {
//     function __construct()
//     {
//         $this->message = "Project Full Message";
//     }
// }

// $proj1 = new Project();
// $proj1->supervisor = new Doctor("mai");
// try {
//     $proj1->add_student(new Student("ahmed"));
//     $proj1->add_student(new Student("dalia"));
//     $proj1->add_student(new Student("soad"));
//     $proj1->add_student(new Student("Dina"));
// } catch (ProjectFullException $exp) {
//     echo $exp->getMessage();
// }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//example 6 on Creating a Custom Exception Class
// class customException extends Exception
// {
//     public function errorMessage()
//     {
//         //error message
//         $errorMsg = 'Error on line ' . $this->getLine() . ' in ' . $this->getFile()
//             . ': <b>' . $this->getMessage() . '</b> is not a valid E-Mail address';
//         return $errorMsg;
//     }
// }
// $email = "someone@example...com";
// // The "try" block is executed and an exception is thrown since the e-mail address is invalid
// //The "catch" block catches the exception and displays the error message

// try {
//     //check if
//     if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
//         //throw exception if email is not valid
//         throw new customException($email);
//     }
// } catch (customException $e) {
//     //display custom message
//     echo $e->errorMessage();
// }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//example 7 on multiple exceptions
// class customException extends Exception
// {
//     public function errorMessage()
//     {
//         //error message
//         $errorMsg = 'Error on line ' . $this->getLine() . ' in ' . $this->getFile()
//             . ': <b>' . $this->getMessage() . '</b> is not a valid E-Mail address';
//         return $errorMsg;
//     }
// }
// $email = "someone@example.com";
// try {
//     //check if
//     if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
//         //throw exception if email is not valid
//         throw new customException($email);
//     }
//     //check for "example" in mail address
//     if (strpos($email, "example") !== FALSE) {
//         throw new Exception("$email is an example e-mail");
//     }
// } catch (customException $e) {
//     echo $e->errorMessage();
// } catch (Exception $e) {
//     echo $e->getMessage();
// }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//example 8 on re-throwing exception
class customException extends Exception
{
    public function errorMessage()
    {
        //error message
        $errorMsg = $this->getMessage() . ' is not a valid E-Mail address.';
        return $errorMsg;
    }
}
//$email variable is set to a string that is a valid e-mail address, but contains the string "example"
$email = "someone@example.com";
//The "try" block contains another "try" block to make it possible to re-throw the exception
//The exception is triggered since the e-mail contains the string "example"
//The "catch" block catches the exception and re-throws a "customException"
//The "customException" is caught and displays an error message

//If the exception is not caught in its current "try" block, it will search for a catch block on "higher levels".
try {
    try {
        //check for "example" in mail address
        if (strpos($email, "example") !== FALSE) {
            //throw exception if email is not valid
            throw new Exception($email);
        }
    } catch (Exception $e) {
        //re-throw exception
        throw new customException($email);
    }
} catch (customException $e) {
    //display custom message
    echo $e->errorMessage();
}
