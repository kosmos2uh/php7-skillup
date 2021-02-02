<?php

use App\Entity\Ingredient;
use App\Helpers\FlashMessage;

if(!empty($_POST)) {
    $name = trim($_POST['name'] ?? '');

    if($name != '') {
        $ingredient = new Ingredient();
        $ingredient->name = $name;
        if($ingredient->add()) {
            FlashMessage::addSuccess('Ингредиент ' . $name . ' успешно добавлен');
            redirect(url('admin_entity_list', ['entity' => 'ingredients']));
        } else {
            FlashMessage::addError('Ингредиент ' . $name . ' не добавлен');
            redirect(url('admin_entity_add', ['entity' => 'ingredients']), 307);
        }
    } else {
        FlashMessage::addError('Ингредиент ' . $name . ' не добавлен, не все поля заполнены корректно');
    }
} else {
    FlashMessage::addError('Ингредиент не добавлен, отсутствуют входные данные');
}

redirect(url('admin_entity_list', ['entity' => 'ingredients']));
