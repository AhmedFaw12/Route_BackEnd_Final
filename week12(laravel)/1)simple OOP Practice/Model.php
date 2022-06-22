<?php

abstract class Model{
    protected $id;
    protected $class_name;
    public $table_name;
    public $columns = [];

    public abstract function fill($values);

    function getId(){
        return $this->id;
    }

    function getClassName(){
        return $this->class_name;
    }
}