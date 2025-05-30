<?php

namespace src\Models\Articles;
use src\Models\ActiveRecordEntity;
use src\Models\Users\User;
use src\Models\Comments\Comment;
use src\Services\Db;

class Article extends ActiveRecordEntity
{
        protected $title;
        protected $text;
        protected $authorId;
        protected $createdAt;

        protected static function getTableName(){
            return 'articles';
        }

        public function setTitle(string $title){
            $this->title = $title;
        }
        public function setText(string $text){
            $this->text = $text;
        }
        public function setAuthor(User $author){
            $this->authorId = $author;
        }
        public function getTitle()
        {
            return $this->title;
        }
        public function getText()
        {
            return $this->text;
        }
        public function getAuthorId() :User
        {
            return User::getById($this->authorId);
        }
        public function getCreatedAt()
        {
            return $this->createdAt;
        }

        /**
         * @return Comment[]
         */
        public function getComments(): array
        {
            $db = Db::getInstance();
            $sql = 'SELECT * FROM ' . Comment::getTableName() . ' WHERE article_id = :article_id ORDER BY created_at DESC';
            $result = $db->query($sql, [':article_id' => $this->getId()], Comment::class);
            return $result ?? [];
        }
    }
