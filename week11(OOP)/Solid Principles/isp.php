<?php  

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


?>