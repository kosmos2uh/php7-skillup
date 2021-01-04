<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/include/core/functions.php';

$routes = [
    'main_page' => ['/', '/', 'index'],
    'news_list' => ['/news/', '/news/', 'news/list'],
    'news_detail' => ['/news/([0-9]+)-([0-9a-z-]+).html', '/news/<id>-<vvv_id>.html', 'news/detail'],
    'contacts' => ['/contacts/', '/contacts/', 'contacts/index'],
    'contacts_send_form' => ['/contacts/send/', '/contacts/send/', 'contacts/send'],
];

// роуты, для которых не нужны шапка и подвал
$arRoutesWithoutHeaderAndFooter = [
    'contacts_send_form',
];

$arRoute = getRoute();

// получаем путь к файлу
$page_file = $_SERVER['DOCUMENT_ROOT'] . '/pages/' . $arRoute['page'] . '.php';

// если файл не существует, подключаем 404 страницу
if(!is_file($page_file)) {
    $page_file = $_SERVER['DOCUMENT_ROOT'] . '/pages/404.php';
}

$need_header_and_footer = !in_array($arRoute['name'], $arRoutesWithoutHeaderAndFooter);

if($need_header_and_footer) {
    printTemplateHtml('header');
}

include $page_file;

if($need_header_and_footer) {
    printTemplateHtml('footer');
}
