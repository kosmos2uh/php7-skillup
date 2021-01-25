<?php
$arData = [];

if(!empty($_POST)) {
    $arData = $_POST;
}

$arData['categories_all'] = getCategoriesListStructured();

printTemplateHtml('admin/categories/add', $arData);
