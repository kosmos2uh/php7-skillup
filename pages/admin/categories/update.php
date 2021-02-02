<?php

if(!empty($_POST)) {
    $id = intval($_POST['id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $parent_id = intval($_POST['parent_id'] ?? 0);

    if($id > 0 && $name != '') {
        $result = updateCategory($id, $name, $parent_id);
        if($result == true) {
            redirect(url('admin_entity_list', ['entity' => 'categories']));
        } else {
            redirect(url('admin_entity_edit', ['entity' => 'categories', 'id' => $id]), 307);
        }
    }
}

redirect(url('admin_entity_list', ['entity' => 'categories']));
