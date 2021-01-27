<?php

use App\Entity\Ingredient;

if(!empty($_POST)) {
    $ingredient = new Ingredient($_POST['id'] ?? 0);
    if($ingredient->id > 0) {

        $ingredient->name = trim($_POST['name'] ?? $ingredient->name);

        if($ingredient->update()) {
            redirect(url('admin_ingredients'));
        } else {
            redirect(url('admin_ingredients_edit', ['id' => $ingredient->id]), 307);
        }
    }
}

redirect(url('admin_ingredients'));
