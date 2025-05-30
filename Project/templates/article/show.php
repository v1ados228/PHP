<?php include __DIR__ . '/../header.php'; ?>
<div class="container mt-4">
    <div class="article">
        <div class="d-flex justify-content-between align-items-center">
            <h1><?= htmlspecialchars($article->getTitle()) ?></h1>
            <div>
                <a href="/PHP/Project/www/article/<?= $article->getId() ?>/edit" class="btn btn-primary">Редактировать</a>
                <a href="/PHP/Project/www/article/<?= $article->getId() ?>/delete" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить эту статью? Все комментарии также будут удалены.')">Удалить</a>
            </div>
        </div>
        <p class="text-muted">Автор: <?= htmlspecialchars($article->getAuthorId()->getNickname()) ?></p>
        <div class="article-content mb-5">
            <?= nl2br(htmlspecialchars($article->getText())) ?>
        </div>
    </div>

    <hr>
    <h2>Комментарии</h2>
    <?php
    $comments = $article->getComments();
    if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): ?>
            <div class="comment card mb-3" id="comment<?= $comment->getId() ?>">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="mb-1"><?= nl2br(htmlspecialchars($comment->getText())) ?></p>
                            <small class="text-muted">
                                Автор: <?= htmlspecialchars($comment->getAuthor()->getNickname()) ?> | 
                                Дата: <?= $comment->getCreatedAt() ?>
                            </small>
                        </div>
                        <div>
                            <a href="/PHP/Project/www/comment/<?= $comment->getId() ?>/edit" class="btn btn-sm btn-outline-primary">Редактировать</a>
                            <a href="/PHP/Project/www/comment/<?= $comment->getId() ?>/delete" class="btn btn-sm btn-outline-danger" onclick="return confirm('Вы уверены, что хотите удалить этот комментарий?')">Удалить</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Комментариев пока нет.</p>
    <?php endif; ?>

    <div class="mt-4">
        <h3>Добавить комментарий</h3>
        <form action="/PHP/Project/www/article/<?= $article->getId() ?>/comments" method="post">
            <div class="mb-3">
                <label for="text" class="form-label">Текст комментария</label>
                <textarea name="text" id="text" rows="3" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
