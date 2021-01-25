<?php
$id = intval($arRoute['param']['id'] ?? 0);
$result = deleteIngredient($id);
redirect(url('admin_ingredients'));
