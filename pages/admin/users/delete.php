<?php

use App\Entity\User;

$user = new User($arRoute['param']['id'] ?? 0);
$user->delete();
redirect(url('admin_users'));
