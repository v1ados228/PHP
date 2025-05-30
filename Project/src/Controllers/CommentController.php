<?php

namespace src\Controllers;

use src\View\View;
use src\Models\Comments\Comment;
use src\Models\Articles\Article;
use src\Services\Db;

class CommentController
{
    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * Добавление нового комментария
     */
    public function add(int $articleId): void
    {
        if (empty($_POST['text'])) {
            $this->view->renderHtml('error/error', ['error' => 'Текст комментария не может быть пустым'], 400);
            return;
        }

        $article = Article::getById($articleId);
        if ($article === null) {
            $this->view->renderHtml('error/404', ['error' => 'Статья не найдена'], 404);
            return;
        }

        $comment = new Comment();
        $comment->setText($_POST['text']);
        $comment->articleId = $articleId;
        $comment->authorId = 1; // Временно используем ID 1 как автора
        $comment->createdAt = date('Y-m-d H:i:s');
        $comment->save();

        header('Location: /PHP/Project/www/article/' . $articleId);
        exit();
    }

    /**
     * Отображение формы редактирования
     */
    public function edit(int $commentId): void
    {
        $comment = Comment::getById($commentId);
        if ($comment === null) {
            $this->view->renderHtml('error/404', ['error' => 'Комментарий не найден'], 404);
            return;
        }

        $this->view->renderHtml('comments/edit', ['comment' => $comment]);
    }

    /**
     * Обновление комментария
     */
    public function update(int $commentId): void
    {
        $comment = Comment::getById($commentId);
        if ($comment === null) {
            $this->view->renderHtml('error/404', ['error' => 'Комментарий не найден'], 404);
            return;
        }

        if (empty($_POST['text'])) {
            $this->view->renderHtml('error/error', ['error' => 'Текст комментария не может быть пустым'], 400);
            return;
        }

        $comment->setText($_POST['text']);
        $comment->save();

        header('Location: /PHP/Project/www/article/' . $comment->getArticle()->getId());
        exit();
    }

    /**
     * Удаление комментария
     */
    public function delete(int $commentId): void
    {
        $comment = Comment::getById($commentId);
        if ($comment === null) {
            $this->view->renderHtml('error/404', ['error' => 'Комментарий не найден'], 404);
            return;
        }

        $articleId = $comment->getArticle()->getId();
        $comment->delete();

        header('Location: /PHP/Project/www/article/' . $articleId);
        exit();
    }
} 