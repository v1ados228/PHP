<?php

namespace src\Models\Comments;

use src\Models\ActiveRecordEntity;
use src\Models\Users\User;
use src\Models\Articles\Article;

class Comment extends ActiveRecordEntity
{
    protected $authorId;
    protected $articleId;
    protected $text;
    protected $createdAt;

    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    public function getArticle(): Article
    {
        return Article::getById($this->articleId);
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public static function createComment(array $fields, User $author, Article $article): Comment
    {
        $comment = new Comment();
        
        $comment->authorId = $author->getId();
        $comment->articleId = $article->getId();
        $comment->text = $fields['text'];
        $comment->createdAt = date('Y-m-d H:i:s');
        
        $comment->save();
        
        return $comment;
    }

    protected static function getTableName(): string
    {
        return 'comments';
    }
} 