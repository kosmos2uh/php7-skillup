<?php

use App\Entity\Category;
use App\Helpers\FlashMessage;

if(!empty($_POST)) {
    $name = trim($_POST['name'] ?? '');
    $parent_id = intval($_POST['parent_id'] ?? 0);

    if($name != '') {
        $category = new Category();
        $category->name = $name;
        $category->parent_id = $parent_id;
        if($category->add()) {
            FlashMessage::addSuccess('Категория ' . $name . ' успешно добавлена');
            redirect(url('admin_entity_list', ['entity' => 'categories']));
        } else {
            FlashMessage::addError('Категория ' . $name . ' не добавлена');
            redirect(url('admin_entity_add', ['entity' => 'categories']), 307);
        }
    } else {
        FlashMessage::addError('Категория ' . $name . ' не добавлена, не все поля заполнены корректно');
    }
} else {
    FlashMessage::addError('Категория не добавлена, отсутствуют входные данные');
}

redirect(url('admin_entity_list', ['entity' => 'categories']));
