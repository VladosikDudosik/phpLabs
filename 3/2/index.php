<?php
$a = 121.2;
$b = 3.8;
function x($q)
{
    global $a,$b;
    return sqrt(1.5 * $a - $b * $q) * (tan(pow($q, 2)/(5*M_PI))/(pow(M_E, $q)+$b));
}
echo "a = " . $a . "</br>b = " . $b . "</br>";
for ($i = 1.4 ; $i < 1.85 ; $i+= 0.05) {
    echo "x({$i}) =  ".x($i) ."</br>";
}
?>