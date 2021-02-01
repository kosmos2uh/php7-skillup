<?php

$arRouteToPage = [
    'admin_entity_list' => 'list',
    'admin_entity_add' => 'add',
    'admin_entity_create' => 'create',
    'admin_entity_update' => 'update',
    'admin_entity_edit' => 'edit',
    'admin_entity_delete' => 'delete',
];

$entity = $arRoute['param']['entity'] ?? '';
if(!empty($entity)) {

    $page = $arRouteToPage[$arRoute['name']] ?? '';

    if(!empty($page)) {
        $file = $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/' . $entity . '/' . $page . '.php';
        if(is_file($file)) {
            include $file;
        }
    }

}
