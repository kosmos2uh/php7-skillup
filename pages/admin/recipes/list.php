<?php
$arRecipes = getRecipesList();
printTemplateHtml('admin/recipes/list', $arRecipes);
