<?php  

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

?>