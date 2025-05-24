<?php
function showContacts($sort = 'created', $pageNum = 1) {
    $conn = new mysqli("localhost", "root", "root", "contacts", 3306);
    if ($conn->connect_error) {
        return "Ошибка подключения к базе данных.";
    }

    // Определение поля сортировки
    switch ($sort) {
        case 'surname':
            $orderBy = 'lastname';
            break;
        case 'birthdate':
            $orderBy = 'birthdate';
            break;
        default:
            $orderBy = 'id';
    }

    $limit = 10;
    $offset = ($pageNum - 1) * $limit;

    // Получаем общее количество записей
    $totalRes = $conn->query("SELECT COUNT(*) AS total FROM people");
    $totalRows = $totalRes ? $totalRes->fetch_assoc()['total'] : 0;
    $totalPages = ceil($totalRows / $limit);

    // Получаем текущие записи
    $sql = "SELECT * FROM people ORDER BY $orderBy ASC LIMIT $offset, $limit";
    $result = $conn->query($sql);
    if (!$result) {
        return "Ошибка запроса: " . $conn->error;
    }

    // Строим таблицу
    $html = "<table border='1' cellpadding='5' cellspacing='0'>";
    $html .= "<tr>
                <th><a href='?page=view&sort=surname'>Фамилия</a></th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Пол</th>
                <th><a href='?page=view&sort=birthdate'>Дата рождения</a></th>
                <th>Телефон</th>
                <th>Адрес</th>
                <th>Email</th>
                <th>Комментарий</th>
                <th>Редактировать | Удалить</th>
    </tr>";
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $html .= "<tr>";
        $html .= "<td>" . htmlspecialchars($row['lastname'] ?? '') . "</td>";
        $html .= "<td>" . htmlspecialchars($row['firstname'] ?? '') . "</td>";
        $html .= "<td>" . htmlspecialchars($row['patronymic'] ?? '') . "</td>";
        $html .= "<td>" . htmlspecialchars($row['gender'] ?? '') . "</td>";
        $html .= "<td>" . htmlspecialchars($row['birthdate'] ?? '') . "</td>";
        $html .= "<td>" . htmlspecialchars($row['phone'] ?? '') . "</td>";
        $html .= "<td>" . htmlspecialchars($row['address'] ?? '') . "</td>";
        $html .= "<td>" . htmlspecialchars($row['email'] ?? '') . "</td>";
        $html .= "<td>" . htmlspecialchars($row['comment'] ?? '') . "</td>";
        $html .= "<td>
            <a href='?page=edit&id={$row['id']}'>Редактировать</a> | 
            <a href='?page=delete&id={$row['id']}' onclick=\"return confirm('Удалить запись {$row['lastname']} {$row['firstname']}?');\">Удалить</a>
        </td>";
        $html .= "</tr>";
    }
    $html .= "</table>";

    // Построение пагинации
    $html .= "<div class='pagination' style='margin-top:10px;'>";
    for ($i = 1; $i <= $totalPages; $i++) {
        $active = ($i == $pageNum) ? "style='border:2px solid black;'" : "";
        $html .= "<a href='?page=view&sort=$sort&pageNum=$i' $active>$i</a> ";
    }
    $html .= "</div>";

    $conn->close();
    return $html;
}

// Если вызывается напрямую, то вывести таблицу по параметрам из GET
if (basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__)) {
    $sort = $_GET['sort'] ?? 'created';
    $pageNum = intval($_GET['pageNum'] ?? 1);
    echo showContacts($sort, $pageNum);
}
?>