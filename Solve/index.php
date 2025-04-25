<?php
$equation = "X+67=129";

[$left, $right] = explode('=', $equation);

if (strpos($left, 'X') !== false) {
    $expr = $left;
    $result = (int)$right;
} 
else {
    $expr = $right;
    $result = (int)$left;
}

if (preg_match('/X([\+\-\*\/])(\d+)/', $expr, $matches)) {
    $op = $matches[1];
    $num = (int)$matches[2];

    switch ($op) {
        case '+': $x = $result - $num; break;
        case '-': $x = $result + $num; break;
        case '*': $x = $result / $num; break;
        case '/': $x = $result * $num; break;
    }

    echo "Уравнение: $equation<br>";
    echo "Оператор: $op<br>";
    echo "Число: $num<br>";
    echo "Значение X: $x";
} 
else {
    echo "Формат уравнения не распознан.";
}
?>