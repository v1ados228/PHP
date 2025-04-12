<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Морозов Владислав Алексеевич 241-321 Лаб2</title>
</head>
<body>
    <header style="display: flex; justify-content: left; gap: 5%;">
        <img src="./Logo_Polytech_rus_main.jpg" alt="Логотип" style="width: 30%; height: 20%;">
        <h1>Домашняя работа: Feedback form</h1>
    </header>
    <main>
        <?php
            $result = get_headers("https://httpbin.org/post");
            echo "<textarea>";
                print_r($result);
            echo "</textarea>";
        ?>
    </main>
    <footer>
        <p>Морозов Владислав Алексеевич 241-321 Лаб2</p>
        <p><?php echo date("l"); ?></p>
    </footer>
</body>
</html>