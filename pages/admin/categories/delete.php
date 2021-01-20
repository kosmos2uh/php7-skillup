<?php
$id = intval($arRoute['param']['id'] ?? 0);
$result = deleteCategory($id);
header("Location: " . url('admin_categories'));
