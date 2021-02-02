<?php

use App\Entity\User;
use App\Helpers\FlashMessage;

if(!empty($_POST)) {
    $id = intval($_POST['id'] ?? 0);
    $user = new User($_POST['id'] ?? 0);
    if($user->id > 0) {
        $user->name = trim($_POST['name'] ?? $user->name);
        $user->email = trim($_POST['email'] ?? $user->email);
        $user->is_admin = isset($_POST['is_admin']) && $_POST['is_admin'] == 1 ? 1 : $user->is_admin;
        $user->password = trim($_POST['password'] ?? '');

        if($user->update()) {
            FlashMessage::addSuccess('Пользователь ' . $user->name . ' успешно изменен');
            redirect(url('admin_entity_list', ['entity' => 'users']));
        } else {
            FlashMessage::addError('Пользователя ' . $user->name . ' не удалось изменить');
            redirect(url('admin_entity_edit', ['entity' => 'users', 'id' => $user->id]), 307);
        }
    } else {
        FlashMessage::addError('Пользователь не найден');
    }
} else {
    FlashMessage::addError('Пользователь не изменен, отсутствуют входные данные');
}

redirect(url('admin_entity_list', ['entity' => 'users']));
