<?php

return [
    // '~^$~'=>[\src\Controllers\MainController::class, 'main'],
    '~^$~' => ['src\Controllers\ArticleController', 'index'],
    '~^article/(\d+)/edit$~' => ['src\Controllers\ArticleController', 'edit'],
    '~^article/(\d+)/update$~' => ['src\Controllers\ArticleController', 'update'],
    '~^article/(\d+)$~' => ['src\Controllers\ArticleController', 'show'],
    '~^article/(\d+)/delete$~' => ['src\Controllers\ArticleController', 'delete'],
    '~^article/create$~' => ['src\Controllers\ArticleController', 'create'],
    '~^article/store$~' => ['src\Controllers\ArticleController', 'store'],
    '~^article/(\d+)/comments$~' => ['src\Controllers\ArticleController', 'addComment'],
    '~^comment/(\d+)/edit$~' => ['src\Controllers\CommentController', 'edit'],
    '~^comment/(\d+)/update$~' => ['src\Controllers\CommentController', 'update'],
    '~^comment/(\d+)/delete$~' => ['src\Controllers\CommentController', 'delete'],
    '~^hello/(.+)$~'=>['src\Controllers\MainController', 'sayHello'],
];