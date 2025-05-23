<?php
session_start();

// Проверяем, установлена ли страна в сессии
if (!isset($_SESSION['user_country'])) {
    header('Location: index3.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Лабораторная №6</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Задание №4</h2>
        <p>Сохраненная страна: <strong><?php echo $_SESSION['user_country']; ?></strong></p>
        <p><a href="index3.php">Вернуться на главную</a></p>
    </body>
</html>