<?php
$conn = new mysqli("localhost", "root", "root", "contacts", 3306);
if ($conn->connect_error) {
    die("Ошибка подключения к БД");
}

// Получаем список всех записей
$result = $conn->query("SELECT id, lastname, firstname FROM people ORDER BY lastname, firstname");
if (!$result) {
    die("Ошибка запроса к БД");
}

// Определяем текущий id из GET, или первый, если не передан
$currentId = isset($_GET['id']) ? intval($_GET['id']) : null;
if (!$currentId && $result->num_rows > 0) {
    $firstRow = $result->fetch_assoc();
    $currentId = $firstRow['id'];
    $result->data_seek(0);
}

// Выводим список ссылок с выделением текущей записи
echo "<div>";
while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $label = htmlspecialchars($row['lastname'] . " " . $row['firstname']);
    $style = ($id == $currentId) ? "style='font-weight:bold;color:red'" : "";
    echo "<a href='?page=edit&id=$id' $style>$label</a><br>";
}
echo "</div>";

// Получаем данные текущей записи по id
$record = null;
if ($currentId) {
    $res = $conn->query("SELECT * FROM people WHERE id = $currentId LIMIT 1");
    if ($res) {
        $record = $res->fetch_assoc();
    }
}

// Обработка POST (обновление)
$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && $record) {
    // Экранирование
    $lastname = $conn->real_escape_string($_POST['surname']);
    $firstname = $conn->real_escape_string($_POST['name']);
    $patronymic = $conn->real_escape_string($_POST['patronymic']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $birthdate = $conn->real_escape_string($_POST['birthdate']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $email = $conn->real_escape_string($_POST['email']);
    $comment = $conn->real_escape_string($_POST['comment']);

    $sql = "UPDATE people SET 
            lastname='$lastname',
            firstname='$firstname',
            patronymic='$patronymic',
            gender='$gender',
            birthdate='$birthdate',
            phone='$phone',
            address='$address',
            email='$email',
            comment='$comment'
            WHERE id=$currentId";

    if ($conn->query($sql)) {
        $successMessage = "Запись обновлена.";
        // Обновляем данные
        $res = $conn->query("SELECT * FROM people WHERE id = $currentId LIMIT 1");
        if ($res) {
            $record = $res->fetch_assoc();
        }
    } else {
        $errorMessage = "Ошибка обновления записи.";
    }
}

// Вывод сообщений
if ($successMessage) echo "<p style='color: green;'>$successMessage</p>";
if ($errorMessage) echo "<p style='color: red;'>$errorMessage</p>";
?>

<?php if ($record): ?>
<form method="POST">
    <label>Фамилия: <input name="surname" value="<?= htmlspecialchars($record['lastname']) ?>" required></label><br>
    <label>Имя: <input name="name" value="<?= htmlspecialchars($record['firstname']) ?>" required></label><br>
    <label>Отчество: <input name="patronymic" value="<?= htmlspecialchars($record['patronymic']) ?>"></label><br>
    <label>Пол:
        <select name="gender" required>
            <option value="муж" <?= $record['gender'] == 'муж' ? 'selected' : '' ?>>М</option>
            <option value="жен" <?= $record['gender'] == 'жен' ? 'selected' : '' ?>>Ж</option>
        </select>
    </label><br>
    <label>Дата рождения: <input type="date" name="birthdate" value="<?= htmlspecialchars($record['birthdate']) ?>" required></label><br>
    <label>Телефон: <input name="phone" value="<?= htmlspecialchars($record['phone']) ?>" required></label><br>
    <label>Адрес: <input name="address" value="<?= htmlspecialchars($record['address']) ?>"></label><br>
    <label>Email: <input name="email" type="email" value="<?= htmlspecialchars($record['email']) ?>" required></label><br>
    <label>Комментарий:<br><textarea name="comment"><?= htmlspecialchars($record['comment']) ?></textarea></label><br>
    <button type="submit">Сохранить изменения</button>
</form>
<?php else: ?>
<p>Запись не найдена.</p>
<?php endif; ?>