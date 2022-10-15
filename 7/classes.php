<?php 
abstract class Value{
        protected $v;
        function __construct($v)
        {
            if($v < 0){
                throw new ErrorException();
            }
            $this->v = $v;
        }
        function __get($v){
            return $this->v;
        }
        function __set($v,$value){
            if($v < 0){
                throw new ErrorException();
            }
            $this->v = $value;
        }
        abstract function ToKilogram();
    }
    //Грам
    class Gram extends Value{
        function ToKilogram(){
            return $this->v/1000;
        }
    }
    //Фут
    class Pound extends Value{
        function ToKilogram(){
            return $this->v * 2.2046;
        }
    }
    //Пуд
    class Food extends Value{
        function ToKilogram(){
            return $this->v/16.38049;
        }
    }
?>