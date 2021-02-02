<?php

use App\Entity\Category;
use App\Helpers\FlashMessage;

if(!empty($_POST)) {

    $category = new Category($_POST['id'] ?? 0);

    if($category->id > 0) {

        $category->name = trim($_POST['name'] ?? $category->name);
        $category->parent_id = intval($_POST['parent_id'] ?? $category->parent_id);

        if($category->update()) {
            FlashMessage::addSuccess('Категория ' . $category->name . ' успешно изменена');
            redirect(url('admin_entity_list', ['entity' => 'categories']));
        } else {
            FlashMessage::addError('Категорию ' . $category->name . ' не удалось изменить');
            redirect(url('admin_entity_edit', ['entity' => 'categories', 'id' => $category->id]), 307);
        }

    } else {
        FlashMessage::addError('Категория не найдена');
    }
} else {
    FlashMessage::addError('Категория не изменена, отсутствуют входные данные');
}

redirect(url('admin_entity_list', ['entity' => 'categories']));
