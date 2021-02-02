<?php

use App\Entity\Category;
use App\Helpers\FlashMessage;

$category = new Category($arRoute['param']['id'] ?? 0);
$name = $category->name;
if($category->delete()) {
    FlashMessage::addSuccess('Категория ' . $name . ' удалена');
} else {
    FlashMessage::addError('Категорию ' . $name . ' не удалось удалить');
}
redirect(url('admin_entity_list', ['entity' => 'categories']));
