<?php include __DIR__ . '/../header.php'; ?>
<div class="container mt-4">
    <h1>Редактирование комментария</h1>
    <form action="/PHP/Project/www/comment/<?= $comment->getId() ?>/update" method="post">
        <div class="mb-3">
            <label for="text" class="form-label">Текст комментария</label>
            <textarea name="text" id="text" rows="3" class="form-control" required><?= htmlspecialchars($comment->getText()) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="/PHP/Project/www/article/<?= $comment->getArticle()->getId() ?>" class="btn btn-secondary">Отмена</a>
    </form>
</div>
<?php include __DIR__ . '/../footer.php'; ?> 