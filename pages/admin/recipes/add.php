<?php

use App\Entity\Category;
use App\Entity\Ingredient;

$arData = [];

if(!empty($_POST)) {
    $arData = $_POST;
}

$arData['ingredients_list'] = Ingredient::getList();
$arData['categories_list'] = Category::getListStructured();

printTemplateHtml('admin/recipes/add', $arData);
