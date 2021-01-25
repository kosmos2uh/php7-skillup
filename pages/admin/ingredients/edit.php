<?php
$arData = getIngredientItem($arRoute['param']['id'] ?? 0);

if(!empty($_POST)) {
    $arData = $_POST;
}

printTemplateHtml('admin/ingredients/edit', $arData);
