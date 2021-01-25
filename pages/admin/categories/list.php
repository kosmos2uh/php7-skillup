<?php
$arCategories = getCategoriesListStructured();
printTemplateHtml('admin/categories/list', $arCategories);
