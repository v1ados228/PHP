<?php
function getMenu() {
    $active = $_GET['page'] ?? 'view';
    $menu = [
        'view' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записи',
        'delete' => 'Удаление записи'
    ];

    $html = '<nav>';
    foreach ($menu as $key => $label) {
        $color = ($active === $key) ? 'red' : 'blue';
        $html .= "<a href='?page=$key' style='color:$color; margin-right: 10px;'>$label</a>";
    }
    $html .= '</nav>';

    // Если "Просмотр" — добавим подменю сортировки
    if ($active === 'view') {
        $sort = $_GET['sort'] ?? 'created';
        $sortMenu = [
            'created' => 'По добавлению',
            'surname' => 'По фамилии',
            'birthdate' => 'По дате рождения'
        ];

        $html .= '<div style="font-size: small; margin-top: 10px;">';
        foreach ($sortMenu as $key => $label) {
            $color = ($sort === $key) ? 'red' : 'blue';
            $html .= "<a href='?page=view&sort=$key' style='color:$color; margin-right: 5px;'>$label</a>";
        }
        $html .= '</div>';
    }

    return $html;
}
?>