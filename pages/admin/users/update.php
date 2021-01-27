<?php

use App\Entity\User;

if(!empty($_POST)) {
    $id = intval($_POST['id'] ?? 0);
    $user = new User($_POST['id'] ?? 0);
    if($user->id > 0) {
        $user->name = trim($_POST['name'] ?? $user->name);
        $user->email = trim($_POST['email'] ?? $user->email);
        $user->is_admin = isset($_POST['is_admin']) && $_POST['is_admin'] == 1 ? 1 : $user->is_admin;
        $user->password = trim($_POST['password'] ?? '');

        if($user->update()) {
            redirect(url('admin_users'));
        } else {
            redirect(url('admin_users_edit', ['id' => $user->id]), 307);
        }
    } else {
        redirect(url('admin_users'));
    }
}
redirect(url('admin_users'));
