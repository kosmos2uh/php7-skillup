<?php

use App\Entity\Category;
use App\Entity\Recipe;

$arCategories = Category::getTree(0, 1);

$arRecipes = Recipe::getList(6);

printTemplateHtml('index/index', [
    'categories' => $arCategories,
    'recipes' => $arRecipes,
]);
