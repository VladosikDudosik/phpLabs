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

$arr = [1,25,30,54,-1,20,30,54,51,1000];
echo '<h3>Конвертування різних значеннь до кілограму</h3>';

for($i = 0 ; $i < count($arr); $i++)
{
    echo '-------------------------</br>';
    echo '<b>Значення = ' . $arr[$i] . '</b></br>';
    try
    {
        $gram = new Gram($arr[$i]);
        $pound = new Pound($arr[$i]);
        $food = new Food($arr[$i]);
    }
    catch(ErrorException $e)
    {
        echo 'Помилка! Некоректне значення.</br>';
        continue;
    }
   
    echo 'Грам = '.$gram->ToKilogram().'</br>';
    echo 'Фут = '. $pound->ToKilogram().'</br>';
    echo 'Пуд = '. $food->ToKilogram().'</br>';

}

?>
