<?php

$user = new \App\Entity\User($arRoute['param']['id'] ?? 0);
$user->delete();
redirect(url('admin_users'));
