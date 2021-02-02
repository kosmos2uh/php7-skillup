<?php

use App\Entity\Recipe;
use App\Entity\User;
use App\Helpers\FlashMessage;

if(!empty($_POST)) {

    $recipe = new Recipe($_POST['id'] ?? 0);

    if($recipe->id > 0) {
        $name = trim($_POST['name'] ?? '');
        $user = new User($_POST['user_id'] ?? 0);
        $description = trim($_POST['description'] ?? '');
        $date = trim($_POST['date'] ?? '');
        $arIngredients = $_POST['ingredients'] ?? [];
        $arCategories = $_POST['categories'] ?? [];

        if($name != '' && $description != '' && $date != '') {
            $recipe->name = $name;
            $recipe->description = $description;
            $recipe->date = $date;
            $recipe->user = $user;
            if($recipe->update($arIngredients,$arCategories)) {
                FlashMessage::addSuccess('Рецепт ' . $recipe->name . ' успешно изменен');
                redirect(url('admin_entity_list', ['entity' => 'recipes']));
            } else {
                FlashMessage::addError('Рецепт ' . $recipe->name . ' не удалось изменить');
                redirect(url('admin_entity_edit', ['entity' => 'recipes', 'id' => $recipe->id]), 307);
            }
        } else {
            FlashMessage::addError('Рецепт ' . $recipe->name . ' не удалось изменить, не все поля заполнены корректно');
        }
    } else {
        FlashMessage::addError('Рецепт не найден');
    }
} else {
    FlashMessage::addError('Рецепт не изменен, отсутствуют входные данные');
}

redirect(url('admin_entity_list', ['entity' => 'recipes']));
