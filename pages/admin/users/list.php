<?php
$arUsers = getUserList();
printTemplateHtml('admin/users/list', $arUsers);
