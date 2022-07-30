<?php  

namespace TechStore\Classes;

class Cart{
    public function add(string $id, array $prodData){
        $_SESSION["cart"][$id] = $prodData;
    }

    public function count(){
        $count = 0;
        if(isset($_SESSION["cart"])){
            foreach($_SESSION["cart"] as $id=> $prodData){
                $count += $prodData["qty"];
            }
            // return count($_SESSION['cart']);
        }
        return $count;   
    }

    public function total(){
        $total = 0;
        if (isset($_SESSION["cart"])) {
            foreach($_SESSION["cart"] as $id => $prodData){
                $total += $prodData["qty"] * $prodData["price"];
            }
        }
        return $total;
    }

    public function has(string $id) : bool{
        if(isset($_SESSION["cart"])){
            return array_key_exists($id, $_SESSION["cart"]);
        }
        return false;
    }

    public function all(){
        if(isset($_SESSION["cart"]))
            return $_SESSION["cart"];
        
        return [];
    }

    public function remove($id){
        unset($_SESSION["cart"][$id]);
    }

    public function empty(){
        $_SESSION["cart"] = [];
    }
}
?>