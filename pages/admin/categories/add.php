<?php

use App\Entity\Category;

$arData = [];

if(!empty($_POST)) {
    $arData = $_POST;
}

$arData['categories_all'] = Category::getListStructured();

printTemplateHtml('admin/categories/add', $arData);
