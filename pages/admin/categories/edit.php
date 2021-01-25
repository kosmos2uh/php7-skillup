<?php
$arData = getCategoryItem($arRoute['param']['id'] ?? 0);

if(!empty($_POST)) {
    $arData = $_POST;
}

$arData['categories_all'] = getCategoriesListStructured();

printTemplateHtml('admin/categories/edit', $arData);
