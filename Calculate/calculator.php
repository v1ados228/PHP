<?php
header('Content-Type: text/plain');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем выражение из POST-запроса
    $expression = $_POST['expression'] ?? '';
    
    // Проверяем выражение на безопасность
    if (!preg_match('/^[0-9+\-*\/()\.\s]+$/', $expression)) {
        echo "Ошибка: Недопустимые символы в выражении";
        exit;
    }
    
    // Вычисляем выражение
    try {
        $result = evaluateExpression($expression);
        echo $result;
    } catch (Exception $e) {
        echo "Ошибка: " . $e->getMessage();
    }
} else {
    echo "Ожидается POST-запрос";
}


//Рекурсивно вычисляет математическое выражение
function evaluateExpression($expression) {
    // Удаляем пробелы
    $expression = str_replace(' ', '', $expression);
    
    // Обрабатываем скобки рекурсивно
    while (($openPos = strrpos($expression, '(')) !== false) {
        $closePos = strpos($expression, ')', $openPos);
        if ($closePos === false) {
            throw new Exception("Непарные скобки");
        }
        
        $subExpr = substr($expression, $openPos + 1, $closePos - $openPos - 1);
        $subResult = evaluateExpression($subExpr);
        $expression = substr_replace($expression, $subResult, $openPos, $closePos - $openPos + 1);
    }
    
    // Проверяем на наличие скобок после обработки
    if (strpos($expression, '(') !== false || strpos($expression, ')') !== false) {
        throw new Exception("Непарные скобки");
    }
    
    // Обрабатываем умножение и деление
    $expression = preg_replace_callback('/(\d+\.?\d*)([\/\*])(\d+\.?\d*)/', function($matches) {
        $a = floatval($matches[1]);
        $b = floatval($matches[3]);
        switch ($matches[2]) {
            case '*': return $a * $b;
            case '/': 
                if ($b == 0) throw new Exception("Деление на ноль");
                return $a / $b;
        }
    }, $expression);
    
    // Обрабатываем сложение и вычитание
    $expression = preg_replace_callback('/(\d+\.?\d*)([+\-])(\d+\.?\d*)/', function($matches) {
        $a = floatval($matches[1]);
        $b = floatval($matches[3]);
        switch ($matches[2]) {
            case '+': return $a + $b;
            case '-': return $a - $b;
        }
    }, $expression);
    
    // Проверяем, что осталось только число
    if (!is_numeric($expression)) {
        throw new Exception("Некорректное выражение");
    }
    
    return $expression;
}
?>