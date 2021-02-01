<?php

use App\Entity\Ingredient;
use App\Helpers\FlashMessage;

if(!empty($_POST)) {
    $name = trim($_POST['name'] ?? '');

    if($name != '') {
        $ingredient = new Ingredient();
        $ingredient->name = $name;
        if($ingredient->add()) {
            FlashMessage::addSuccess('Ингредиент ' . $ingredient->name . ' успешно добавлен');
            redirect(url('admin_ingredients'));
        } else {
            FlashMessage::addError('Ингредиент ' . $ingredient->name . ' не добавлен');
            redirect(url('admin_ingredients_add'), 307);
        }
    }
}

redirect(url('admin_ingredients'));
