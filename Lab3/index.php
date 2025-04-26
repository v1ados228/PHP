<?php
//1
header('Content-Type: text/html; charset=UTF-8');

function processWords(&$words) {
    foreach ($words as $i => &$word) {
        if ($i % 2 == 1) $word = mb_strtoupper($word, 'UTF-8');
    }
}

$text = $_REQUEST['text'] ?? '';
$result = '';

if ($text) {
    $words = preg_split('/\s+/u', $text);
    processWords($words);
    $result = implode(' ', $words);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Морозов Владислав 241-321</title>
</head>
<body>
    <h2>Задание 1</h2>
    <form method="POST">
        <textarea name="text" rows="5" cols="50"><?php 
            echo htmlspecialchars($text ?? ''); 
        ?></textarea><br>
        <input type="submit" value="Преобразовать">
    </form>
    
    <?php if (!empty($result)): ?>
    <h2>Результат:</h2>
    <p><?php echo htmlspecialchars($result); ?></p>
    <?php endif; ?>
</body>
</html>
<?php
//2
echo "<h2>Задание 2</h2>";
$filePath = __DIR__ . '/test.txt';

$content = '12345';

file_put_contents($filePath, $content);

if (file_exists($filePath)) {
    echo "Текст успешно записан!";
} else {
    echo "Ошибка при создании файла";
}
?>
<?php
//3
echo "<h2>Задание 3</h2>";
$files = ['3.1.txt', '3.2.txt', '3.3.txt'];

$combinedContent = '';

foreach ($files as $filename) {
    if (file_exists($filename)) {
        $combinedContent .= file_get_contents($filename);
    } else {
        echo "Файл $filename не найден!<br>";
    }
}

if (!empty($combinedContent)) {
    file_put_contents('new.txt', $combinedContent);
    echo "Файл new.txt успешно создан с объединенным содержимым!";
} else {
    echo "Не удалось получить содержимое файлов для объединения.";
}
?>
<?php
//4
echo "<h2>Задание 4</h2>";
$files = ['4.1.txt', '4.2.txt', '4.3.txt'];

foreach ($files as $filename) {
    if (file_exists($filename)) {
        $content = file_get_contents($filename);
        
        $content .= '!';
        
        file_put_contents($filename, $content);
        
        echo "Файл $filename успешно обновлен!<br>";
    } else {
        echo "Файл $filename не найден!<br>";
    }
}

echo "Обработка файлов завершена.";
?>
<?php
//5
echo "<h2>Задание 5</h2>";
$filename = 'count.txt';

if (!file_exists($filename)) {
    file_put_contents($filename, '0');
}

$currentCount = (int)file_get_contents($filename);

$currentCount++;

file_put_contents($filename, $currentCount);

echo "Количество обновлений страницы: " . $currentCount;
?>