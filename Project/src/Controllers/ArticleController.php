<?php

namespace src\Controllers;
use src\View\View;
use src\Models\Articles\Article;
use src\Models\Comments\Comment;
use src\Services\Db;

class ArticleController
{
    private $view;
    private $db;
    public function __construct()
    {
        $this->view = new View;  
    }

    public function index(){
        $articles = Article::findAll();
        $this->view->renderHtml('article/index', ['articles'=>$articles]);
    }

    public function show($id){
        $article = Article::getById($id);
        if ($article === null || $article === false || $article === []) {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }
        $this->view->renderHtml('article/show', ['article' => $article]);
    }

    public function edit($id){
        $article = Article::getById($id);
        if ($article === null || $article === false || $article === []) {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }
        $this->view->renderHtml('article/edit', ['article'=>$article]);
    }

    public function update($id){
        $article = Article::getById($id);
        if ($article === null || $article === false || $article === []) {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }
        $article->title = $_POST['title'];
        $article->text = $_POST['text'];
        $article->save();
        header('Location: /PHP/Project/www/article/'.$article->getId());
        exit();
    }

    public function create(){
        $this->view->renderHtml('article/create');
    }

    public function store(){
        $article = new Article;
        $article->title = $_POST['title'];
        $article->text = $_POST['text'];
        $article->authorId = 1;
        $article->save();
        header('Location: /PHP/Project/www/');
        exit();
    }

    public function delete(int $id){
        $article = Article::getById($id);
        if ($article === null || $article === false || $article === []) {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }
        $article->delete();
        header('Location: /PHP/Project/www/');
        exit();
    }

    public function addComment($articleId) {
        $article = Article::getById($articleId);
        if ($article === null || $article === false || $article === []) {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }

        if (empty($_POST['text'])) {
            $this->view->renderHtml('error/error', ['error' => 'Текст комментария не может быть пустым'], 400);
            return;
        }

        $db = Db::getInstance();
        $sql = 'INSERT INTO comments (article_id, author_id, text, created_at) VALUES (:article_id, :author_id, :text, NOW())';
        $db->query($sql, [
            ':article_id' => $articleId,
            ':author_id' => 1, // Используем ID 1 как дефолтный для неавторизованных пользователей
            ':text' => $_POST['text']
        ]);

        header('Location: /PHP/Project/www/article/' . $articleId);
        exit();
    }
}