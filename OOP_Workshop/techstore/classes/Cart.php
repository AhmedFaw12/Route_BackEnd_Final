<?php  

namespace TechStore\Classes;

class Cart{
    public function add(string $id, array $prodData){
        $_SESSION["cart"][$id] = $prodData;
    }

    public function count(){
        $count = 0;
        foreach($_SESSION["cart"] as $prodData){
            $count += $prodData["qty"];
        }
        // return count($_SESSION['cart']);
        return $count;   
    }

    public function total(){
        $total = 0;
        foreach($_SESSION["cart"] as $prodData){
            $total += $prodData["qty"] * $prodData["price"];
        }

        return $total;
    }

    public function has(string $id) : bool{
        return array_key_exists($id, $_SESSION["cart"]);
    }

    public function all(){
        return $_SESSION["cart"];
    }

    public function remove($id){
        unset($_SESSION["cart"][$id]);
    }

    public function empty(){
        $_SESSION["cart"] = [];
    }
}
?>