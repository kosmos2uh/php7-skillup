<?php
$id = intval($arRoute['param']['id'] ?? 0);
$result = deleteUser($id);
redirect(url('admin_users'));
