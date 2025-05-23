<?php
session_start();

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['country'])) {
    $_SESSION['user_country'] = htmlspecialchars($_POST['country']);
    header('Location: test.php');
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
        
        <?php if (isset($_SESSION['user_country'])): ?>
            <p>Ваша страна уже сохранена: <?php echo $_SESSION['user_country']; ?></p>
            <p><a href="test.php">Перейти на test.php</a></p>
        <?php else: ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <label for="country">Страна:</label>
                <input type="text" id="country" name="country" required>
                <button type="submit">Сохранить</button>
            </form>
        <?php endif; ?>
    </body>
</html>