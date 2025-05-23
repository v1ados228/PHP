<?php
session_start();

// Инициализируем счетчик, если его еще нет в сессии
if (!isset($_SESSION['refresh_count'])) {
    $_SESSION['refresh_count'] = 0;
    $message = "Вы еще не обновляли страницу. Это ваш первый заход!";
} else {
    $_SESSION['refresh_count']++;
    $message = "Количество обновлений страницы: " . $_SESSION['refresh_count'];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Лабораторная №6</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Задание №3</h2>
        <p><?php echo $message; ?></p>
        <p><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Обновить страницу</a></p>
    </body>
</html>