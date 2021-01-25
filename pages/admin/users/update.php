<?php

if(!empty($_POST)) {
    $id = intval($_POST['id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $is_admin = isset($_POST['is_admin']) && $_POST['is_admin'] == 1 ? 1 : 0;
    $password = trim($_POST['password'] ?? '');

    if($id > 0 && $name != '' && $email != '') {
        $result = updateUser($id, $name, $email, $is_admin, $password);
        if($result == true) {
            redirect(url('admin_users'));
        } else {
            redirect(url('admin_users_edit', ['id' => $id]));
        }
    }
}
redirect(url('admin_users'));
