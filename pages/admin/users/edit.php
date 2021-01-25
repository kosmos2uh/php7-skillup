<?php
$arUser = getUserItem($arRoute['param']['id'] ?? 0);

if(!empty($_POST)) {
    $arUser = $_POST;
}

printTemplateHtml('admin/users/edit', $arUser);
