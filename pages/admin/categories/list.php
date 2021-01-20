<?php
$arCategories = getCategoriesList();
printTemplateHtml('admin/categories/list', $arCategories);
