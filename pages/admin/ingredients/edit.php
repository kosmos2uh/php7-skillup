<?php

use App\Entity\Ingredient;

$ingredient = new Ingredient($arRoute['param']['id'] ?? 0);

printTemplateHtml('admin/ingredients/edit', $ingredient);
