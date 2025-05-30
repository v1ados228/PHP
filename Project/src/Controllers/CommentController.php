<?php

namespace src\Controllers;

use src\View\View;
use src\Models\Comments\Comment;
use src\Services\Db;

class CommentController
{
    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function edit($commentId)
    {
        $comment = Comment::getById($commentId);
        if ($comment === null) {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }

        $this->view->renderHtml('comments/edit', ['comment' => $comment]);
    }

    public function update($commentId)
    {
        $comment = Comment::getById($commentId);
        if ($comment === null) {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }

        if (empty($_POST['text'])) {
            $this->view->renderHtml('error/error', ['error' => 'Текст комментария не может быть пустым'], 400);
            return;
        }

        $comment->setText($_POST['text']);
        $comment->save();

        header('Location: /PHP/Project/www/article/' . $comment->getArticle()->getId() . '#comment' . $comment->getId());
        exit();
    }

    public function delete($commentId)
    {
        $comment = Comment::getById($commentId);
        if ($comment === null) {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }

        $articleId = $comment->getArticle()->getId();
        $comment->delete();

        header('Location: /PHP/Project/www/article/' . $articleId);
        exit();
    }
} 