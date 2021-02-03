<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/include/core/functions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/app/Autoloader.php';

AutoLoader::register();

use \App\Auth;
use \App\Route;

$route = new Route();

// получаем путь к файлу
$page_file = $_SERVER['DOCUMENT_ROOT'] . '/pages/' . $route->page . '.php';

// если файл не существует, подключаем 404 страницу
if(!is_file($page_file)) {
    $page_file = $_SERVER['DOCUMENT_ROOT'] . '/pages/404.php';
}

//include $_SERVER['DOCUMENT_ROOT'] . '/smarty-3.1.36/libs/Smarty.class.php';
//$smarty = new Smarty();

$need_header_and_footer = $route->needHeaderFooter();

$header_template = 'header';
$footer_template = 'footer';
if($route->isAdminRoute()) {
    $header_template = 'admin/header';
    $footer_template = 'admin/footer';

    if(!Auth::isAdmin()) {
        redirect(url('main_page'));
    }
}

if($need_header_and_footer) {
    printTemplateHtml($header_template);
}

include $page_file;

if($need_header_and_footer) {
    printTemplateHtml($footer_template);
}
