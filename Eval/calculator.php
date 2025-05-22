<?php
require_once 'trigonometry.php';

header('Content-Type: text/plain');

function evaluateExpression($expression) {
    // Обработка тригонометрических функций: sin, cos, tan
    $expression = preg_replace_callback('/(sin|cos|tan)\(([^)]+)\)/',
        function($matches) {
            $func = $matches[1];
            $angle = evaluateExpression($matches[2]); // рекурсивно разбираем аргумент
            return calculateTrigonometric($func, $angle);
        },
        $expression
    );

    // Удаляем пробелы
    $expression = str_replace(' ', '', $expression);

    // Обработка скобок (рекурсивная)
    while (($openPos = strrpos($expression, '(')) !== false) {
        $closePos = strpos($expression, ')', $openPos);
        if ($closePos === false) throw new Exception("Непарные скобки");

        $subExpr = substr($expression, $openPos + 1, $closePos - $openPos - 1);
        $subResult = evaluateExpression($subExpr);
        $expression = substr_replace($expression, $subResult, $openPos, $closePos - $openPos + 1);
    }

    // Умножение и деление — итеративно, пока есть операции
    while (preg_match('/(\d+\.?\d*)([\/\*])(\d+\.?\d*)/', $expression)) {
        $expression = preg_replace_callback('/(\d+\.?\d*)([\/\*])(\d+\.?\d*)/', function($matches) {
            $a = floatval($matches[1]);
            $b = floatval($matches[3]);
            switch ($matches[2]) {
                case '*': return $a * $b;
                case '/':
                    if ($b == 0) throw new Exception("Деление на ноль");
                    return $a / $b;
            }
        }, $expression, 1);
    }

    // Сложение и вычитание — итеративно, как выше
    while (preg_match('/(\d+\.?\d*)([+\-])(\d+\.?\d*)/', $expression)) {
        $expression = preg_replace_callback('/(\d+\.?\d*)([+\-])(\d+\.?\d*)/', function($matches) {
            $a = floatval($matches[1]);
            $b = floatval($matches[3]);
            switch ($matches[2]) {
                case '+': return $a + $b;
                case '-': return $a - $b;
            }
        }, $expression, 1);
    }

    // Финальная проверка
    if (!is_numeric($expression)) {
        throw new Exception("Некорректное выражение");
    }

    return $expression;
}

// Обработка запроса из файла expression.txt
if (isset($_GET['file'])) {
    try {
        $filePath = __DIR__ . '/Task/expression.txt';
        if (!file_exists($filePath)) {
            throw new Exception("Файл expression.txt не найден в папке Task");
        }

        $expression = trim(file_get_contents($filePath));

        // Проверка безопасности выражения
        if (!preg_match('/^[0-9+\-*\/().\ssincota]+$/', strtolower($expression))) {
            throw new Exception("Недопустимые символы в выражении");
        }

        $result = evaluateExpression($expression);
        echo $result;
    } catch (Exception $e) {
        echo "Ошибка: " . $e->getMessage();
    }
    exit;
}

// Обработка POST-запроса от index.html
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['expression'])) {
    try {
        $expression = trim($_POST['expression']);

        // Проверка безопасности выражения
        if (!preg_match('/^[0-9+\-*\/().\ssincota]+$/i', $expression)) {
            throw new Exception("Недопустимые символы в выражении");
        }

        $result = evaluateExpression($expression);
        echo $result;
    } catch (Exception $e) {
        echo "Ошибка: " . $e->getMessage();
    }
    exit;
}
?>