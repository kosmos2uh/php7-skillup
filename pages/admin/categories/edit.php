<?php

use App\Entity\Category;

$arData = [
    'category' => new Category($arRoute['param']['id'] ?? 0),
    'categories_all' => Category::getListStructured(),
];

printTemplateHtml('admin/categories/edit', $arData);
