<?php

use App\Entity\Ingredient;

if(!empty($_POST)) {
    $name = trim($_POST['name'] ?? '');

    if($name != '') {
        $ingredient = new Ingredient();
        $ingredient->name = $name;
        if($ingredient->add()) {
            redirect(url('admin_ingredients'));
        } else {
            redirect(url('admin_ingredients_add'), 307);
        }
    }
}

redirect(url('admin_ingredients'));
