<?php

if(!empty($_POST)) {
    $name = trim($_POST['name'] ?? '');
    $user_id = intval($_POST['user_id'] ?? 0);
    $description = trim($_POST['description'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $arIngredients = $_POST['ingredients'] ?? [];
    $arCategories = $_POST['categories'] ?? [];

    if($name != '') {
        $result = addRecipe($name, $description, $user_id, $date, $arIngredients, $arCategories);
        if($result == true) {
            redirect(url('admin_recipes'));
        } else {
            redirect(url('admin_recipes_add'), 307);
        }
    }
}

redirect(url('admin_recipes'));
