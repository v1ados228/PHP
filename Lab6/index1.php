<?php
//1
echo "<h2>Задание 1:</h2>";
session_start();

if (!isset($_SESSION['test_data'])) {
    $_SESSION['test_data'] = 'test';
    echo "Данные 'test' были записаны в сессию. Обновите страницу чтобы увидеть их.";
} else {
    echo "Содержимое сессии: " . $_SESSION['test_data'];
}
?>
