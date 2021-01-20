<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/include/core/functions.php';

$routes = [
    'main_page' => ['/', '/', 'index'],
    'news_list' => ['/news/', '/news/', 'news/list'],
    'news_detail' => ['/news/([0-9]+)-([0-9a-z-]+).html', '/news/<id>-<vvv_id>.html', 'news/detail'],
    'contacts' => ['/contacts/', '/contacts/', 'contacts/index'],
    'contacts_send_form' => ['/contacts/send/', '/contacts/send/', 'contacts/send'],

    'admin_users' => ['/admin/users/', '/admin/users/', 'admin/users/list'],
    'admin_users_add' => ['/admin/users/add/', '/admin/users/add/', 'admin/users/add'],
    'admin_users_edit' => ['/admin/users/edit/([0-9]+)/', '/admin/users/edit/<id>/', 'admin/users/edit'],
    'admin_users_delete' => ['/admin/users/delete/([0-9]+)/', '/admin/users/delete/<id>/', 'admin/users/delete'],
];

// роуты, для которых не нужны шапка и подвал
$arRoutesWithoutHeaderAndFooter = [
    'contacts_send_form',
    'admin_users_delete',
];

$arRoute = getRoute();

// получаем путь к файлу
$page_file = $_SERVER['DOCUMENT_ROOT'] . '/pages/' . $arRoute['page'] . '.php';

// если файл не существует, подключаем 404 страницу
if(!is_file($page_file)) {
    $page_file = $_SERVER['DOCUMENT_ROOT'] . '/pages/404.php';
}

//include $_SERVER['DOCUMENT_ROOT'] . '/smarty-3.1.36/libs/Smarty.class.php';
//$smarty = new Smarty();

$need_header_and_footer = !in_array($arRoute['name'], $arRoutesWithoutHeaderAndFooter);

$header_template = 'header';
$footer_template = 'footer';
if(strpos($arRoute['name'], 'admin_') === 0) {
    $header_template = 'admin/header';
    $footer_template = 'admin/footer';
}

if($need_header_and_footer) {
    printTemplateHtml($header_template);
}

include $page_file;

if($need_header_and_footer) {
    printTemplateHtml($footer_template);
}
