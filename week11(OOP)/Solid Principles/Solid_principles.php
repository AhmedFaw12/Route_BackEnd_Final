<?php  
/*

Solid Principles:
    -Intro
        -every letter in (Solid) represents a principle
        -Single Responsbility principle(SRP) -->S
        -Open/Closed principle(OCP) -->O
        -liskov substitution principle(LSP) -->L
        -Interface segregation principle(ISP) -->I
        -Dependency inversion principle(DIP) -->D
    
    -Single Responsibility(SRP):
        -every class make/responsible for single task, even if it has many methods
        -Example:
            -we will make a User Class
            -this class will contain methods for receive user data coming through post request,  login , logout, sendSuccessResponse after login

            -so our code will be alot 
            -so instead of this , we will make classes :
                -class UserAuth :responsible for login, logout
                -class UserRequest :responsible to receive request
                -class UserResponse :responsible for user response 

        -this principle will move us from making few classes with large code to many classes with few code
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    -Open/closed principle(OCP):
        -open for extension
        -closed for edit

        -arrange your classes such that when we need to add a new functionality, we don't play/mess with old class and make a new class instead

        Example:
            OCP.php:
                Wrong(wrong principle) Code:
                    class Calculator{
                        public function calculate($x, $y, $op){
                            if($op == 'add'){
                                return $x + $y;
                            }elseif($op == 'sub'){
                                return $x - $y;
                            }elseif($op == 'mul'){
                                return $x * $y;
                            }elseif($op == 'div'){
                                return $x / $y;
                            }
                        }
                    }

                    $calc = new Calculator;
                    echo $calc->calculate(3, 4, new Add);
                
                    -if we need to add a new operation, we will edit the code(make new elseif) and this violates open/closed principle
                --------------------------------------------------------------------------------------------------------------------------------------------------------------

                right Code:
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

                    class Calculator{
                        public function calculate($x, $y,Operation $op){
                            return $op->calculate($x, $y);
                        }
                    }

                    $calc = new Calculator;
                    echo $calc->calculate(3, 4, new Add);

                    -we made an interface(Operation) with abstract method calculate
                    -we made a class for every operation that implements Operation interface
                    -we will make class Calculator that contain method calculate
                    -we will pass object of Operation to our method

        Conclusion:
            -multiple if else statements and each else statement contain operation different from previous statement ,,and switch cases violates open closed principle
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    -Liskov substitution principle(LSP):
        -it shows us when to inherit class and how to inherit it correctly
        
        main conditions to inherit:
            -don't inherit class that contains some methods child class will not use
            -child class must be Is-A relation:
                Example: Eagle Is-A bird
            
        
        Example:
            lsp.php:
                wrong code: 
                    class Bird{
                        public function eat(){
                            
                        }
                        public function fly(){

                        }
                    }

                    class Eagle extends Bird{

                    }

                    class Duck extends Bird{

                    }
                    -eagle is a bird and can fly and eat ,so correct inheritance
                    -Duck is a bird and can eat but cannot fly ,so Incorrect inheritance
                    -duck can't inherit bird


                right code:
                    class Bird{
                        public function eat(){
                            
                        }
                    }

                    class FlyingBird extends Bird{
                        public function fly(){

                        }
                    }

                    class Eagle extends FlyingBird{

                    }

                    class Duck extends Bird{

                    }
                    -we will change class bird
                    -all birds can eat , but not all birds can fly
                    -so we will put fly method in seperate class that will inherits from bird class
                    -Bird->flyingBird->Eagle
                    -Bird->Duck
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    -Interface segragation principle:
        -similar to liskov principle but for interfaces
        -it tells us how to implements interfaces correctly

        Conditions to implement Interface:
            -don't implements interface if it has some methods that we won't need

        Example:
            isp.php:
                Wrong Code:
                    interface printer{
                        public function print();
                        public function scan();
                    }


                    class PrinterHp implements Printer{
                        public function print(){

                        }
                        public function scan(){

                        }
                    }
                    class PrinterAyhaga implements Printer{
                        public function print(){

                        }
                    }

                    -we made an interface printer with 2 methods to be implemented (print, scan)
                    -these 2 methods must be implemented , or it will give syntax error

                    -PrinterHp  will print and scan

                    -PrinterAyhaga only needs to print, but it will give me error if we didn't implements scan() method

                Right Code:
                    interface printer{
                        public function print();        
                    }

                    interface Scanner{
                        public function scan();
                    }

                    class PrinterHp implements Printer, Scanner{
                        public function print(){

                        }
                        public function scan(){

                        }
                    }
                    class PrinterAyhaga implements Printer{
                        public function print(){

                        }
                    }

                    -interface printer will contain common method
                    -and extra method scan will be put in seperate interface
                    -so PrinterAyhaga will implements printer interface only
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    -Dependancy Inversion principle(DIP):
        -don't depend on option classes seperately
        -depend on interface (that collect these classes)

        -The Dependency Inversion Principle (DIP) states that high-level modules should not depend on low-level modules; both should depend on abstractions. Abstractions should not depend on details. Details should depend upon abstractions.

        dip.php:
            Wrong Code:
                class Order{
                    public function payWithVisa(Visa $visa){
                        echo "paid with visa";
                    }
                    public function payWithPaypal(Paypal $paypal){
                        echo "paid with paypal";
                    }
                    public function payWithCash(Cash $cash){
                        echo "paid with cash";
                    }
                }

                class Visa{

                }

                class Paypal{

                }

                class Cash{

                }

                -order class depends on option classes seperately(visa, paypal, cash)
                -if i want to add new option class , we will add new function for it in our main class(Order)
            
            right Code:
                class Order{
                public function finishPayment(PaymentMethod $method){
                    $method->pay();
                }
                }

                interface PaymentMethod{
                    public function pay();
                }

                class Visa{
                    public function pay(){
                        echo "paid with visa";
                    }
                }

                class Paypal{
                    public function pay(){
                        echo "paid with paypal";
                    }
                }

                class Cash{
                    public function pay(){
                        echo "paid with cash";
                    }
                }

                -we will make interface that collect these classes(visa, paypal, cash)
                -each of these classes implements pay method
                -in order class we will make one method that will call pay method of option class

*/
?>