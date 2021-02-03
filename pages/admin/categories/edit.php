<?php

use App\Entity\Category;

$arData = [
    'category' => new Category($route->param['id'] ?? 0),
    'categories_all' => Category::getListStructured(),
];

printTemplateHtml('admin/categories/edit', $arData);
