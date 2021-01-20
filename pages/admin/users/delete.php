<?php
$id = intval($_POST['id'] ?? 0);
$result = deleteUser($id);
header("Location: " . url('admin_users'));
