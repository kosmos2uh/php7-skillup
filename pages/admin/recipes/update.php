<?php

if(!empty($_POST)) {
    $id = intval($_POST['id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $user_id = intval($_POST['user_id'] ?? 0);
    $description = trim($_POST['description'] ?? '');
    $date = trim($_POST['date'] ?? '');

    if($id > 0 && $name != '') {
        $result = updateRecipe($id, $name, $description, $user_id, $date);
        if($result == true) {
            redirect(url('admin_recipes'));
        } else {
            redirect(url('admin_recipes_edit', ['id' => $id]), 307);
        }
    }
}

redirect(url('admin_recipes'));
