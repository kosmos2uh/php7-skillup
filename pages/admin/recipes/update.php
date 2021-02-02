<?php

if(!empty($_POST)) {
    $id = intval($_POST['id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $user_id = intval($_POST['user_id'] ?? 0);
    $description = trim($_POST['description'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $arIngredients = $_POST['ingredients'] ?? [];
    $arCategories = $_POST['categories'] ?? [];

    if($id > 0 && $name != '') {
        $result = updateRecipe($id, $name, $description, $user_id, $date, $arIngredients, $arCategories);
        if($result == true) {
            redirect(url('admin_entity_list', ['entity' => 'recipes']));
        } else {
            redirect(url('admin_entity_edit', ['entity' => 'recipes', 'id' => $id]), 307);
        }
    }
}

redirect(url('admin_entity_list', ['entity' => 'recipes']));
