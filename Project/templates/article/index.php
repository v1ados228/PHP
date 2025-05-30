<?php include __DIR__ . '/../header.php'; ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Статьи</h1>
        <a href="/PHP/Project/www/article/create" class="btn btn-primary">Создать статью</a>
    </div>

    <div class="row">
        <?php foreach($articles as $article): ?> 
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/PHP/Project/www/article/<?= $article->getId(); ?>" class="text-decoration-none">
                            <?= htmlspecialchars($article->getTitle()); ?>
                        </a>
                    </h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars(mb_substr($article->getText(), 0, 200))); ?>...</p>
                    <div class="text-muted">
                        <small>Автор: <?= htmlspecialchars($article->getAuthorId()->getNickname()); ?></small><br>
                        <small>Дата: <?= $article->getCreatedAt(); ?></small>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
