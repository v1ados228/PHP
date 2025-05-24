<?php
$conn = new mysqli("localhost", "root", "root", "contacts", 3306);
if ($conn->connect_error) {
    die("Ошибка подключения к БД");
}

$deletedMessage = "";

// Удаление записи по ID (если передан)
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Получаем фамилию для сообщения
    $stmt = $conn->prepare("SELECT lastname FROM people WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        $lastname = htmlspecialchars($row['lastname']);
        $stmt->close();

        // Удаляем запись
        $stmtDel = $conn->prepare("DELETE FROM people WHERE id = ?");
        $stmtDel->bind_param("i", $id);
        if ($stmtDel->execute()) {
            $deletedMessage = "<p style='color: green;'>Запись с фамилией $lastname удалена</p>";
        } else {
            $deletedMessage = "<p style='color: red;'>Ошибка удаления записи: " . $stmtDel->error . "</p>";
        }
        $stmtDel->close();
    } else {
        $deletedMessage = "<p style='color: red;'>Запись не найдена для удаления.</p>";
        $stmt->close();
    }
}

// Получение всех записей
$result = $conn->query("SELECT id, lastname, firstname, patronymic FROM people ORDER BY lastname, firstname");
if (!$result) {
    die("Ошибка получения данных");
}

// Вывод сообщения
echo $deletedMessage;

// Вывод ссылок на удаление
echo "<ul>";
while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $lastname = htmlspecialchars($row['lastname']);
    $initials = mb_substr($row['firstname'], 0, 1) . ".";
    if (!empty($row['patronymic'])) {
        $initials .= mb_substr($row['patronymic'], 0, 1) . ".";
    }
    echo "<li><a href='?page=delete&id=$id' onclick=\"return confirm('Удалить запись $lastname $initials?');\">$lastname $initials</a></li>";
}
echo "</ul>";
?>