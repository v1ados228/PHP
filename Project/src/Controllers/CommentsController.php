<?php

namespace Controllers;

use Models\Comments\Comment;
use Models\Articles\Article;
use Models\Users\User;
use Services\UsersAuthService;

class CommentsController
{
    private $user;

    public function __construct()
    {
        $this->user = UsersAuthService::getUserByToken();
        if ($this->user === null) {
            header('Location: /users/login');
            exit();
        }
    }

    public function add(int $articleId): void
    {
        if (!empty($_POST)) {
            $article = Article::getById($articleId);
            if ($article === null) {
                throw new \Exception('Статья не найдена');
            }

            $comment = Comment::createComment($_POST, $this->user, $article);

            header('Location: /articles/' . $articleId . '#comment' . $comment->getId());
            exit();
        }
    }

    public function edit(int $commentId): void
    {
        $comment = Comment::getById($commentId);
        if ($comment === null) {
            throw new \Exception('Комментарий не найден');
        }

        if ($comment->getAuthor()->getId() !== $this->user->getId()) {
            throw new \Exception('Вы не можете редактировать этот комментарий');
        }

        if (!empty($_POST)) {
            $comment->setText($_POST['text']);
            $comment->save();

            header('Location: /articles/' . $comment->getArticle()->getId() . '#comment' . $comment->getId());
            exit();
        }

        $article = $comment->getArticle();
        require __DIR__ . '/../../templates/comments/edit.php';
    }
} 