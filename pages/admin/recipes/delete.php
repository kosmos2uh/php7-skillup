<?php

use App\Entity\Recipe;
use App\Helpers\FlashMessage;

$recipe = new Recipe($arRoute['param']['id'] ?? 0);
$name = $recipe->name;
if($recipe->delete()) {
    FlashMessage::addSuccess('Рецепт ' . $name . ' удален');
} else {
    FlashMessage::addError('Рецепт ' . $name . ' не удалось удалить');
}
redirect(url('admin_entity_list', ['entity' => 'recipes']));
