<?php

use App\Entity\Category;

$arCategories = Category::getListStructured();
printTemplateHtml('admin/categories/list', $arCategories);
