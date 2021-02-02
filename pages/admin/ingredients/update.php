<?php

use App\Entity\Ingredient;
use App\Helpers\FlashMessage;

if(!empty($_POST)) {
    $ingredient = new Ingredient($_POST['id'] ?? 0);
    if($ingredient->id > 0) {

        $ingredient->name = trim($_POST['name'] ?? $ingredient->name);

        if($ingredient->update()) {
            FlashMessage::addSuccess('Ингредиент ' . $ingredient->name . ' успешно изменен');
            redirect(url('admin_entity_list', ['entity' => 'ingredients']));
        } else {
            FlashMessage::addError('Ингредиент ' . $ingredient->name . ' не удалось изменить');
            redirect(url('admin_entity_edit', ['entity' => 'ingredients', 'id' => $ingredient->id]), 307);
        }
    } else {
        FlashMessage::addError('Ингредиент не найден');
    }
} else {
    FlashMessage::addError('Ингредиент не изменен, отсутствуют входные данные');
}

redirect(url('admin_entity_list', ['entity' => 'ingredients']));
