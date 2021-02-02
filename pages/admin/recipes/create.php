<?php

use App\Entity\Recipe;
use App\Entity\User;
use App\Helpers\FlashMessage;

if(!empty($_POST)) {
    $name = trim($_POST['name'] ?? '');
    $user = new User(intval($_POST['user_id']) ?? 0);
    $description = trim($_POST['description'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $arIngredients = $_POST['ingredients'] ?? [];
    $arCategories = $_POST['categories'] ?? [];

    if($name != '' && $description != '') {
        $recipe = new Recipe();
        $recipe->name = $name;
        $recipe->description = $description;
        $recipe->date = $date;
        $recipe->user = $user;
        if($recipe->add($arIngredients, $arCategories)) {
            FlashMessage::addSuccess('Рецепт ' . $name . ' успешно добавлен');
            redirect(url('admin_entity_list', ['entity' => 'recipes']));
        } else {
            FlashMessage::addError('Рецепт ' . $name . ' не добавлен');
            redirect(url('admin_entity_add', ['entity' => 'recipes']), 307);
        }
    } else {
        FlashMessage::addError('Рецепт ' . $name . ' не добавлен, не все поля заполнены корректно');
    }
} else {
    FlashMessage::addError('Рецепт не добавлен, отсутствуют входные данные');
}

redirect(url('admin_entity_list', ['entity' => 'recipes']));
