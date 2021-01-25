<?php
$arData = getCategoryItem($arRoute['param']['id'] ?? 0);

if(!empty($_POST)) {
    $arData = $_POST;
}

printTemplateHtml('admin/categories/edit', $arData);
