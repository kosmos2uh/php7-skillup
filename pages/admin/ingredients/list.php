<?php

use App\Entity\Ingredient;

$arIngredients = Ingredient::getList();
printTemplateHtml('admin/ingredients/list', $arIngredients);
