<?php

use App\Entity\User;
use App\Helpers\FlashMessage;

$user = new User($route->param['id'] ?? 0);
$name = $user->name;
if($user->delete()) {
    FlashMessage::addSuccess('Пользователь ' . $name . ' удален');
} else {
    FlashMessage::addError('Пользователя ' . $name . ' не удалось удалить');
}
redirect(url('admin_entity_list', ['entity' => 'users']));
