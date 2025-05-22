<?php
function calculateTrigonometric($func, $angle) {
    // Преобразуем градусы в радианы
    $radians = deg2rad(floatval($angle));
    switch (strtolower($func)) {
        case 'sin': return sin($radians);
        case 'cos': return cos($radians);
        case 'tan': return tan($radians);
        default: throw new Exception("Неизвестная функция: $func");
    }
}
?>