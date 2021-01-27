<?php

use App\Entity\Ingredient;

$ingredient = new Ingredient($arRoute['param']['id'] ?? 0);
$ingredient->delete();
redirect(url('admin_ingredients'));
