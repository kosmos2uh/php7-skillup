<?php
$arData = [];

if(!empty($_POST)) {
    $arData = $_POST;
}

printTemplateHtml('admin/ingredients/add', $arData);
