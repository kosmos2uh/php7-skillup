<?php
$arData = getRecipeItem($arRoute['param']['id'] ?? 0);

if(!empty($_POST)) {
    $arData = $_POST;
}

$arData['ingredients_list'] = getIngredientsList();
$arData['categories_list'] = getCategoriesListStructured();

printTemplateHtml('admin/recipes/edit', $arData);
