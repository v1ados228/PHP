<?php
// Задание 1
echo "<h3>Задание 1</h3>";
$array = ['a', 'b', 'c', 'b', 'a'];
$countValues = array_count_values($array);
echo "<pre>Количество: ";
print_r($countValues);
echo "</pre><hr>";

// Задание 2
echo "<h3>Задание 2</h3>";
$array = ['a' => 1, 'b' => 2, 'c' => 3];
$flippedArray = array_flip($array);
echo "<pre>Массив: ";
print_r($flippedArray);
echo "</pre><hr>";

// Задание 3
echo "<h3>Задание 3</h3>";
$array = [1, 2, 3, 4, 5];
$reversedArray = array_reverse($array);
echo "<pre>Массив: ";
print_r($reversedArray);
echo "</pre><hr>";

// Задание 4
echo "<h3>Задание 4</h3>";
$keys = ['a', 'b', 'c'];
$values = [1, 2, 3];
$combinedArray = array_combine($keys, $values);
echo "<pre>Массив: ";
print_r($combinedArray);
echo "</pre><hr>";

// Задание 5
echo "<h3>Задание 5</h3>";
$array = ['a' => 1, 'b' => 2, 'c' => 3];
$keys = array_keys($array);
$values = array_values($array);
echo "<pre>Ключи: ";
print_r($keys);
echo "Значения: ";
print_r($values);
echo "</pre>";
?>