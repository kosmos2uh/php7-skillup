<?php
$arData = getRecipeItem($arRoute['param']['id'] ?? 0);

if(!empty($_POST)) {
    $arData = $_POST;
}

printTemplateHtml('admin/recipes/edit', $arData);
