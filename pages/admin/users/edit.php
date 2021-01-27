<?php

use App\Entity\User;

$user = new User($arRoute['param']['id'] ?? 0);

printTemplateHtml('admin/users/edit', $user);
