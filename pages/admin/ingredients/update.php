<?php

if(!empty($_POST)) {
    $id = intval($_POST['id'] ?? 0);
    $name = trim($_POST['name'] ?? '');

    if($id > 0 && $name != '') {
        $result = updateIngredient($id, $name);
        if($result == true) {
            redirect(url('admin_ingredients'));
        } else {
            redirect(url('admin_ingredients_edit'), 307);
        }
    }
}

redirect(url('admin_ingredients'));
