<?php
session_start();

// Проверяем наличие данных в сессии
if (isset($_SESSION['message'])) {
    echo "Сообщение из сессии: " . $_SESSION['message'];
    
    unset($_SESSION['message']);
} else {
    echo "В сессии нет данных. Вернитесь на <a href='page1.php'>первую страницу</a> чтобы записать их.";
}
?>