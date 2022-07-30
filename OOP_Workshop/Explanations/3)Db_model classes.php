<?php

/*
Database(Db) _model classes:
    -db class connects with Database, make crud operations(selectAll, selectId, selectWhere, insert, update, delete)
    Example:
        config/db_config.php:
            <?php
            const HOST = "localhost";
            const DB_USER = "root";
            const DB_PW = "";
            const DB_NAME = "techstore";
            const DB_PORT = 3306;
        ------------------------------------------------------------------------------------------------------------------------------------------------------
        classes/Db.php:
            <?php

            abstract class Db{
                
                protected $conn;
                protected $table;

                public function connect(){
                    $this->conn = mysqli_connect(HOST, DB_USER, DB_PW, DB_NAME, DB_PORT);
                }
                -this method connects with database
                -since we will use connect() in other methods 
                -so we will make protected $conn property and save the return of mysqli_connect() in it 

                
                --------------------------------------------------------------------------------------------------------------------------------------

                
                public function selectAll(string $fields = "*") : array{
                    $sql = "SELECT $fields FROM $this->table";
                    $result = mysqli_query($this->conn, $sql);

                    return mysqli_fetch_all($result, MYSQLI_ASSOC);
                }
                -we will make protected $table property , since we don't know name of table and in model classes , we will determine table name

                -selectAll :select all records from table
                -return result in an associative array:
                    return mysqli_fetch_all($result, MYSQLI_ASSOC);
                    
                    -Returns an array of associative or numeric arrays holding the result rows and empty array if no rows

                    
                -this function will return array 

                -we tested this method on table has records and on empty table(it will empty array)

                -we added default optional parameter, so that if the user wants to select specific columns and not all of them

                -this parameter is (string $fields = "*") 
                -it will select * unless we told it what to select

                --------------------------------------------------------------------------------------------------------------------------------------


                public function selectId(int $id ,string $fields = "*")
                {
                    $sql = "SELECT $fields FROM $this->table 
                    WHERE id = $id";

                    $result = mysqli_query($this->conn, $sql);

                    return mysqli_fetch_assoc($result);
                }
                
                -selectId : if we want to select certain record/row by id
                -we will pass id as a parameter
                -second paramter is $fields to select certain columns

                -since we are return single record/row ,we will use:
                    return mysqli_fetch_assoc($result);

                    -Returns an associative array of strings representing the fetched row. NULL if there are no more rows in result-set

                    -since it will return NULL if no rows, we didn't make return type (array) 

                we tested this method on table has records and on empty table(it will get NULL)

                --------------------------------------------------------------------------------------------------------------------------------------
                public function selectWhere($conds, string $fields = "*"):array
                {
                    $sql = "SELECT $fields FROM $this->table 
                    WHERE $conds";

                    $result = mysqli_query($this->conn, $sql);

                    return mysqli_fetch_all($result, MYSQLI_ASSOC);
                }

                -selectWhere: similar to selectAll but takes where condition(not on id only)

                -conditions like :" id > 5 AND price <6000 "


                --------------------------------------------------------------------------------------------------------------------------------------
                public function getCount() : int
                {
                    $sql = "SELECT COUNT(*) AS cnt FROM $this->table";
                    $result = mysqli_query($this->conn, $sql);

                    return mysqli_fetch_assoc($result)["cnt"];
                }

                -get the number of rows in certain table
                it will return int:
                    return mysqli_fetch_assoc($result)["cnt"];

                    -since we will return single value we will use :
                        mysqli_fetch_assoc($result)

                    -mysqli_fetch_assoc($result) will return array containing cnt field

                    -so we selected cnt and returned it to user:
                        return mysqli_fetch_assoc($result)["cnt"];

                -we tested getCount():
                    it will return 0 in case of empty table

                --------------------------------------------------------------------------------------------------------------------------------------
                public function insert(string $fields, string $values):bool
                {
                    $sql = "INSERT INTO $this->table ($fields) VALUES($values)";

                    return mysqli_query($this->conn, $sql);
                }

                -insert: to insert record in table , it will take fields/columns names and values 

                -it will bool (true on success and false on fail)

                --------------------------------------------------------------------------------------------------------------------------------------
                public function update(string $set, int $id):bool
                {
                    $sql = "UPDATE $this->table SET $set WHERE id = $id";

                    return mysqli_query($this->conn, $sql);
                }

                -we will use id to determine record to be updated for simplicity
                -it will bool (true on success and false on fail)


                --------------------------------------------------------------------------------------------------------------------------------------
                
                public function delete(int $id):bool{   
                    $sql = "DELETE FROM $this->table WHERE id = $id";
                    return mysqli_query($this->conn, $sql);
                }
                
                -it will bool (true on success and false on fail)
                
                --------------------------------------------------------------------------------------------------------------------------------------
                public function __destruct(){
                    mysqli_close($this->conn);
                }

                -we made a destruct to close connection
            }

            -db classes is made to be inherited by model classes(Product, Cat, Order, OrderDetail)

            -in model classes , we will determine table name and connect and work by methods in Db class
            
            -so since we will not make object from Db class, so we will make it abstract and make its properties protected


        ------------------------------------------------------------------------------------------------------------------------------------------------------

        Classes/Models/Product.php:
            <?php

            class Product extends Db
            {
                public function __construct(){
                    $this->table = "products";
                    $this->connect(); 
                }
            }
            -extends(inherit) Db class
            -In Construct:
                -determine table name
                -make connection
                

        Classes/Models/Order.php:
            <?php

            class Order extends Db
            {
                public function __construct(){
                    $this->table = "orders";
                    $this->connect(); 
                }
            }
        Classes/Models/OrderDetail.php:
            <?php

            class OrderDetail extends Db
            {
                public function __construct(){
                    $this->table = "order_details";
                    $this->connect(); 
                }
            }
        Classes/Models/Cat.php:
            <?php

            class Cat extends Db
            {
                public function __construct(){
                    $this->table = "cats";
                    $this->connect(); 
                }
            }

        
        ------------------------------------------------------------------------------------------------------------------------------------------------------

        test.php:
                <?php

                require_once("classes/Db.php");
                require_once("classes/Models/Product.php");
                require_once("classes/Models/Order.php");

                //testing db class and product class
                $prod = new Product();

                // $res = $prod->selectAll("id, name, price");
                // $res = $prod->selectId(8, "id, name, price");
                // $res = $prod->selectWhere("id > 5 ", "id, name, price");
                // $res = $prod->selectWhere("id > 5 AND price < 6000 ", "id, name, price");
                // $res = $prod->getCount();

                // echo '<pre>';
                // // print_r($res);
                // var_dump($res);
                // echo '</pre>';


                //testing order class
                $ord = new Order();

                // $res = $ord->selectAll();
                // $res = $ord->selectId(1);
                // $res = $ord->getCount();
                // $res = $ord->insert("name, phone", "'mohamed fawzy' ,'010345678' ");
                // $res = $ord->update("name = 'Mohammed Fawzy', email='mohamed@techstore.com'", 1);

                // $res = $ord->delete(1);

                echo '<pre>';
                // print_r($res);
                var_dump($res);
                echo '</pre>';

        
*/
