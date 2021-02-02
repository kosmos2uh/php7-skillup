<?php
$id = intval($arRoute['param']['id'] ?? 0);
$result = deleteRecipe($id);
redirect(url('admin_entity_list', ['entity' => 'recipes']));
