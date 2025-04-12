<?php
//1
echo "Задание 1<br/>";
$a = 15;
$b = 42;

$c = sqrt($a**2 + $b**2);

$rounded = number_format($c, 2);

echo "При a = $a и b = $b, гипотенуза = $rounded<br/>";

//2
echo "Задание 2<br/>";
$c = 75;
$b = 34;
$a = sqrt($c**2 - $b**2);

$rounded = number_format($a, 2);

echo "При гипотенузе c = $c и катете b = $b, другой катет a = $rounded<br/>";

//3
echo "Задание 3<br/>";
$a = 54;
$b = 97;
$c = sqrt($a**2 + $b**2);

$A_rad = asin($a / $c);
$B_rad = asin($b / $c);

$A_deg° = round(rad2deg($A_rad), 2);
$B_deg° = round(rad2deg($B_rad), 2);

$rounded = number_format($c, 2);

echo "Гипотенуза: $rounded<br/>";
echo "Острый угол напротив катета a ($a): $A_deg°<br/>";
echo "Острый угол напротив катета b ($b): $B_deg°<br/>";

//4
echo "Задание 4<br/>";
$a = 27;
$b = 12;
$c = sqrt($a**2 + $b**2);

$A_rad = asin($a / $c);
$B_rad = asin($b / $c);

$A_deg° = round(rad2deg($A_rad), 2);
$B_deg° = round(rad2deg($B_rad), 2);

$C_deg° = 90;

echo "Угол A (напротив a = $a): $A_deg°<br/>";
echo "Угол B (напротив b = $b): $B_deg°<br/>";
echo "Угол C (прямой): $C_deg°<br/>";

//5
echo "Задание 8<br/>";
$a = false;
$b = true;

echo "Значение переменной a: " . ($a ? 'true' : 'false') . "<br/>";
echo "Значение переменной b: " . ($b ? 'true' : 'false') . "<br/>";
?>
