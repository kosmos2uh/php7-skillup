<?php

use App\Entity\User;
use App\Helpers\FlashMessage;

if(!empty($_POST)) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $is_admin = isset($_POST['is_admin']) && $_POST['is_admin'] == 1 ? 1 : 0;
    $password = trim($_POST['password'] ?? '');

    if($name != '' && $email != '' && $password != '') {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->is_admin = $is_admin;
        if($user->add()) {
            FlashMessage::addSuccess('Пользователь ' . $name . ' успешно добавлен');
            redirect(url('admin_entity_list', ['entity' => 'users']));
        } else {
            FlashMessage::addError('Пользователь ' . $name . ' не добавлен');
            redirect(url('admin_entity_add', ['entity' => 'users']), 307);
        }
    } else {
        FlashMessage::addError('Пользователь ' . $name . ' не добавлен, не все поля заполнены корректно');
    }
} else {
    FlashMessage::addError('Пользователь не добавлен, отсутствуют входные данные');
}

redirect(url('admin_entity_list', ['entity' => 'users']));
