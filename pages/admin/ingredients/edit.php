<?php

use App\Entity\Ingredient;

$ingredient = new Ingredient($route->param['id'] ?? 0);

printTemplateHtml('admin/ingredients/edit', $ingredient);
