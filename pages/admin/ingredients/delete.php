<?php

use App\Entity\Ingredient;
use App\Helpers\FlashMessage;

$ingredient = new Ingredient($arRoute['param']['id'] ?? 0);
$name = $ingredient->name;
if($ingredient->delete()) {
    FlashMessage::addSuccess('Ингредиент ' . $name . ' удален');
} else {
    FlashMessage::addError('Ингредиент ' . $name . ' не удалось удалить');
}
redirect(url('admin_entity_list', ['entity' => 'ingredients']));
