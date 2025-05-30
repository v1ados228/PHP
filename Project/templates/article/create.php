<?php include __DIR__ . '/../header.php'; ?>
<div class="container mt-4">
    <h1>Создание новой статьи</h1>
    <form action="/PHP/Project/www/article/store" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Текст статьи</label>
            <textarea class="form-control" id="text" rows="10" name="text" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="/PHP/Project/www/" class="btn btn-secondary">Отмена</a>
    </form>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
