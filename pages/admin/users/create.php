<?php

if(!empty($_POST)) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $is_admin = isset($_POST['is_admin']) && $_POST['is_admin'] == 1 ? 1 : 0;
    $password = trim($_POST['password'] ?? '');

    if($name != '' && $email != '' && $password != '') {
        $result = addUser($name, $email, $is_admin, $password);
        if($result == true) {
            redirect(url('admin_users'));
        } else {
            redirect(url('admin_users_add'), 307);
        }
    }
}
redirect(url('admin_users'));
