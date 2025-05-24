<!DOCTYPE html>
<html lang="ru">
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php
    require_once 'menu.php';
    echo getMenu(); // отображение меню

    $page = $_GET['page'] ?? 'view'; // view, add, edit, delete

    switch ($page) {
        case 'add':
            require 'add.php';
            break;
        case 'edit':
            require 'edit.php';
            break;
        case 'delete':
            require 'delete.php';
            break;
        case 'view':
            default:
                require_once 'viewer.php';
                $sort = $_GET['sort'] ?? 'created';
                $pageNum = intval($_GET['pageNum'] ?? 1);
                echo showContacts($sort, $pageNum);
                break;
    }
    ?>
    </body>
</html>