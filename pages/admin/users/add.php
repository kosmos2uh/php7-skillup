<?php
$arUser = [];

if(!empty($_POST)) {
    $arUser = $_POST;
}

printTemplateHtml('admin/users/add', $arUser);
