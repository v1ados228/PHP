<?php
session_start();

// Записываем время входа, если оно еще не записано
if (!isset($_SESSION['first_visit_time'])) {
    $_SESSION['first_visit_time'] = time();
    $message = "Вы только что зашли на сайт!";
} else {
    $secondsAgo = time() - $_SESSION['first_visit_time'];
    $message = "С момента вашего первого захода прошло: $secondsAgo секунд";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Лабораторная №6</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Задание №5</h2>
        
        <div class="info">
            <p><?php echo $message; ?></p>
        </div>
        
        <p><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Обновить страницу</a></p>
        <p><small>Время сервера: <?php echo date('Y-m-d H:i:s'); ?></small></p>
    </body>
</html>