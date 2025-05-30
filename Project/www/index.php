<?php

spl_autoload_register(function(string $className){
    $className = str_replace('\\', '/', $className);
    require dirname(__DIR__) . '/' . $className . '.php';
});

$route = isset($_GET['route']) ? $_GET['route'] : '';
$patterns = require('route.php');
$findRoute = false;

foreach($patterns as $pattern => $controllerAndAction){
    if(preg_match($pattern, $route, $matches)){
        $findRoute = true;
        unset($matches[0]);
        $action = $controllerAndAction[1];
        $controller = new $controllerAndAction[0];
        $controller->$action(...$matches);
        break;
    }
}

if (!$findRoute) {
    http_response_code(404);
    echo 'Страница не найдена';
}

    // $controller = new src\Controllers\MainController;
    // if (isset($_GET['name'])) $controller->sayHello($_GET['name']);
    // else $controller->main();

    
    // $user = new \src\Models\Users\User('Ivan');
    // $article = new \src\Models\Articles\Article('title', 'text', $user);
    // echo $article->getAuthor()->getName();



