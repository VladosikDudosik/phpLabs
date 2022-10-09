<?php
//Перше завдання
$a = 3.463;
$b = 4.215;

function FirstFunc($y)
{
    return pow(log($y+1),2);
}

function SecondFunc($y)
{
    global $a,$b;
    return sqrt($y) + pow($a, $b-1.5);
}

function Calculate($y)
{
    global $a,$b;
    if ($y < $a) {
        return FirstFunc($y);
    }elseif ($a <= $y && $y <= $b) {
        return SecondFunc($y);
    }else {
        return NAN;
    }
}

$values = [2.86,3.98];
echo "a = " . $a . "</br>b = " . $b . "</br>";
for ($i = 0 ; $i < count($values) ; $i++) {
    echo "z(". $values[$i] .") = " . Calculate($values[$i]).";</br>";
}

?>