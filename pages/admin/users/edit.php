<?php

use App\Entity\User;

$user = new User($route->param['id'] ?? 0);

printTemplateHtml('admin/users/edit', $user);
