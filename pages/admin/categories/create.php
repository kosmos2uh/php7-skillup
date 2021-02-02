<?php

if(!empty($_POST)) {
    $name = trim($_POST['name'] ?? '');
    $parent_id = intval($_POST['parent_id'] ?? 0);

    if($name != '') {
        $result = addCategory($name, $parent_id);
        if($result == true) {
            redirect(url('admin_entity_list', ['entity' => 'categories']));
        } else {
            redirect(url('admin_entity_add', ['entity' => 'categories']), 307);
        }
    }
}

redirect(url('admin_entity_list', ['entity' => 'categories']));
