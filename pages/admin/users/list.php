<?php
use App\Entity\User;

$arUsers = User::getList();
printTemplateHtml('admin/users/list', $arUsers);
