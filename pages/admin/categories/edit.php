<?php
$arData = getCategoryItem($arRoute['param']['id'] ?? 0);

if(!empty($_POST)) {
    $name = trim($_POST['name'] ?? '');
    $parent_id = intval($_POST['parent_id'] ?? 0);
    $id = intval($_POST['id'] ?? 0);

    if($id == $arData['id'] && $name != '') {
        $result = updateCategory($id, $name, $parent_id);
        if($result == true) {
            header("Location: " . url('admin_categories'));
            exit;
        } else {
            $arData['name'] = $name;
            $arData['parent_id'] = $parent_id;
        }
    }
}

printTemplateHtml('admin/categories/edit', $arData);
