<?php
$arData = [];

if(!empty($_POST)) {
    $arData = $_POST;
}

printTemplateHtml('admin/categories/add', $arData);
