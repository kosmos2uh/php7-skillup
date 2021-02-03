<?php

use App\Entity\Category;
use App\Entity\Ingredient;
use App\Entity\Recipe;

$arData = [
    'recipe' => new Recipe($route->param['id'] ?? 0),
    'ingredients_list' => Ingredient::getList(),
    'categories_list' => Category::getListStructured(),
];

printTemplateHtml('admin/recipes/edit', $arData);
