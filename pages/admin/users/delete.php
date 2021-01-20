<?php
$id = intval($arRoute['param']['id'] ?? 0);
$result = deleteUser($id);
header("Location: " . url('admin_users'));
