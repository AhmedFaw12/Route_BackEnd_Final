<?php
require_once("config.php");
require_once("Model.php");
class DB{

    //insert into tables
    static public  function create(Model $model, $values){ 
        
        try{
            
            // values = ["id" = 10, "name"='xxx']
            $pdo = new PDO(DSN, DB_USER, DB_PW);
            
            $col = array_keys($values);//["id", "name"]
            $cols = implode("," , $col); //id,name,....
            $params = ":".implode(",:" , $col); //:id ,:name,:price,:....
    
            $stm = $pdo->prepare("insert into " .$model->table_name. " ($cols) values ($params)");
    
            foreach($values as $col_name => $value){
                $stm->bindValue(":".$col_name, $value);
            }
    
            $stm->execute();
    
            $model->fill($values);
    
            $pdo = null;//close connection
            return $model;
        }catch(Exception $e){
            return null;
        }
    }

    static public function delete(Model $model){
        $pdo = new PDO(DSN, DB_USER,  DB_PW);
        $stm = $pdo->prepare("delete from ". $model->table_name . " where id=:id");
        $stm->bindValue(":id", $model->getId());
        $stm->execute();
        $pdo = null;//close connection
    }

    //find by id
    static public function find($table_name, $class_name ,$id){
        $pdo = new PDO(DSN, DB_USER,  DB_PW);
        $stm = $pdo->prepare("select * from ". $table_name . " where id=:id");
        $stm->bindValue(":id", $id);
        $stm->execute();
        $obj = $stm->fetchObject($class_name);
        
        $pdo = null;//close connection
        return $obj;
    }


    static public function getAll($table_name, $class_name){
        $pdo = new PDO(DSN, DB_USER,  DB_PW);
        $stm = $pdo->prepare("select * from ". $table_name );
        $stm->execute();
        $all = $stm->fetchAll(PDO::FETCH_CLASS, $class_name);//getting associative array 
        
        $pdo = null;//close connection
        return $all;
    }


}