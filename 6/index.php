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
class Data{
    public $key;
    public array $values ;
}

function GetDataFromFile($fileName){
    $fp = fopen($fileName,"r");
    $arr =  new SplFixedArray(count(file($fileName)));
    if($fp){
        for($i = 0 ; !feof($fp); $i++){
            $data = new Data();
            $str = fgets($fp);
            $key = strtok($str," ");
            $str =  str_replace($key.' ' , '',$str);
            $tempArr = explode(" ",$str);

            $data->key = $key ;
            $data->values = $tempArr;
            $arr[$i] = $data;
            
        }
    }else{
        throw new IOException();
    }
    return $arr;
}
$input_file = 'input.txt';
$output_file = 'output.txt';
$arr = GetDataFromFile($input_file);
$result = "";
echo $result;
for($i = 0 ; $i < count($arr);$i++){
    $values = $arr[$i]->values;
    $result .= $arr[$i]->key . ' ';
    switch ($arr[$i]->key){
        case 'Gram':
            echo '<b>Переведення грамів у кілограми:</b><br>';
            for($j = 0 ; $j < count($values);$j ++){
                $gram = new Gram($values[$j]);
                $result .= $gram->ToKilogram() . ' ';
                echo $values[$j] . ' g = ' . $gram->ToKilogram() . ' kg <br>';
            }
            break;
        case 'Pound':
            echo '<b>Переведення футів у кілограми:</b><br>';
            for($j = 0 ; $j < count($values);$j ++){
                $pound = new Pound($values[$j]);
                $result .= $pound->ToKilogram() . ' ';
                echo $values[$j] . ' lb = ' . $pound->ToKilogram() . ' kg <br>';
            }
            break;
        case 'Food':
            echo '<b>Переведення пудів у кілограми:</b><br>';
            for($j = 0 ; $j < count($values);$j ++){
                $food = new Food($values[$j]);
                $result .= $food->ToKilogram() . ' ';
                echo $values[$j] . ' fd = ' . $food->ToKilogram() . ' kg <br>';
            }
            break;
        default:
            echo '<b>Помилка</b></br>';
            break;
    }
    $result .= PHP_EOL;  
}
file_put_contents($output_file,$result);
?>
