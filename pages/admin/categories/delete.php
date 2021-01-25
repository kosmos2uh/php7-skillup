<?php
$id = intval($arRoute['param']['id'] ?? 0);
$result = deleteCategory($id);
redirect(url('admin_categories'));
