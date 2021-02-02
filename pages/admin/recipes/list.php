<?php

use App\Entity\Recipe;

$arRecipes = Recipe::getList();
printTemplateHtml('admin/recipes/list', $arRecipes);
