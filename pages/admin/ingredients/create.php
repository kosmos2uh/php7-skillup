<?php

if(!empty($_POST)) {
    $name = trim($_POST['name'] ?? '');

    if($name != '') {
        $result = addIngredient($name);
        if($result == true) {
            redirect(url('admin_ingredients'));
        } else {
            redirect(url('admin_ingredients_add'), 307);
        }
    }
}

redirect(url('admin_ingredients'));
