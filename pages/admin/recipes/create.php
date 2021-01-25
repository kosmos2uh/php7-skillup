<?php

if(!empty($_POST)) {
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
    exit;
    $name = trim($_POST['name'] ?? '');
    $user_id = intval($_POST['user_id'] ?? 0);
    $description = trim($_POST['description'] ?? '');
    $date = trim($_POST['date'] ?? '');

    if($name != '') {
        $result = addRecipe($name, $description, $user_id, $date);
        if($result == true) {
            redirect(url('admin_recipes'));
        } else {
            redirect(url('admin_recipes_add'), 307);
        }
    }
}

redirect(url('admin_recipes'));
