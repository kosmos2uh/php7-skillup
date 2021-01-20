<?php
$arUser = getUserItem($arRoute['param']['id'] ?? 0);

if(!empty($_POST)) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $is_admin = isset($_POST['is_admin']) && $_POST['is_admin'] == 1 ? 1 : 0;
    $password = trim($_POST['password'] ?? '');
    $id = intval($_POST['id'] ?? 0);

    if($id == $arUser['id'] && $name != '' && $email != '') {
        $result = updateUser($id, $name, $email, $is_admin, $password);
        if($result == true) {
            header("Location: " . url('admin_users'));
            exit;
        } else {
            $arUser['name'] = $name;
            $arUser['email'] = $email;
            $arUser['is_admin'] = $is_admin;
        }
    }
}

printTemplateHtml('admin/users/edit', $arUser);
