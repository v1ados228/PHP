<?php
$successMessage = "";
$errorMessage = "";

// Обработка отправки формы
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "root", "contacts", 3306);

    if ($conn->connect_error) {
        $errorMessage = "Ошибка подключения к базе данных.";
    } else {
        // Получение и экранирование данных
        $lastname = $conn->real_escape_string($_POST['surname']);
        $firstname = $conn->real_escape_string($_POST['name']);
        $patronymic = $conn->real_escape_string($_POST['patronymic']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $birthdate = $conn->real_escape_string($_POST['birthdate']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $address = $conn->real_escape_string($_POST['address']);
        $email = $conn->real_escape_string($_POST['email']);
        $comment = $conn->real_escape_string($_POST['comment']);

        $sql = "INSERT INTO people (lastname, firstname, patronymic, gender, birthdate, phone, address, email, comment) 
                VALUES ('$lastname', '$firstname', '$patronymic', '$gender', '$birthdate', '$phone', '$address', '$email', '$comment')";

        if ($conn->query($sql)) {
            $successMessage = "Запись добавлена.";
        } else {
            $errorMessage = "Ошибка: запись не добавлена. " . $conn->error;
        }

        $conn->close();
    }
}

// Вывод формы и сообщений
if ($successMessage) {
    echo "<p style='color: green;'>$successMessage</p>";
} elseif ($errorMessage) {
    echo "<p style='color: red;'>$errorMessage</p>";
}
?>

<form method="POST">
    <label>Фамилия: <input type="text" name="surname" required></label><br>
    <label>Имя: <input type="text" name="name" required></label><br>
    <label>Отчество: <input type="text" name="patronymic"></label><br>
    <label>Пол:
        <select name="gender" required>
            <option value="муж">М</option>
            <option value="жен">Ж</option>
        </select>
    </label><br>
    <label>Дата рождения: <input type="date" name="birthdate" required></label><br>
    <label>Телефон: <input type="text" name="phone" required></label><br>
    <label>Адрес: <input type="text" name="address"></label><br>
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Комментарий:<br><textarea name="comment"></textarea></label><br>
    <button type="submit">Добавить</button>
</form>