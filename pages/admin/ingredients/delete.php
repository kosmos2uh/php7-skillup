<?php

use App\Entity\Ingredient;

$ingredient = new Ingredient($arRoute['param']['id'] ?? 0);
$name = $ingredient->name;
$ingredient->delete();
\App\Helpers\FlashMessage::addInfo('Ингредиент ' . $name . ' удален');
redirect(url('admin_ingredients'));
