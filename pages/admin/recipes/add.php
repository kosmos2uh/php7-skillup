<?php
$arData = [];

if(!empty($_POST)) {
    $arData = $_POST;
}

printTemplateHtml('admin/recipes/add', $arData);
