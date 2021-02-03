<?php

use App\DataBase\DbConnection;
use App\Route;

function getNews($source, $limit) : array {

    $arNews = [];

    $xml = $source;
    $strXML = file_get_contents($xml);
    $objXML = simplexml_load_string($strXML, 'SimpleXMLElement', LIBXML_NOCDATA);
    $jsonXML = json_encode($objXML);
    $arXML = json_decode($jsonXML, true);

    foreach ($arXML['channel']['item'] as $item) {

        preg_match("/src=\"(.+?)\"/", $item['image'], $matches);
        $image = $matches[1] ?? '';

        $arNews[] = [
            'id' => $item['guid'],
            'datetime' => date('H:i', strtotime($item['pubDate'])),
            'title' => $item['title'],
            'image' => $image,
            'url' => '/detail.php?id=' . $item['guid'],
            'description' => strip_tags($item['description']),
        ];
    }

    $arNews = array_slice($arNews, 0, $limit);

    return $arNews;
}

function getLastNews($limit = 20) : array {
    return getNews('http://k.img.com.ua/rss/ru/all_news2.0.xml', $limit);
}

function getPopularNews($limit = 10) : array {
    return getNews('http://k.img.com.ua/rss/ru/good_news.xml', $limit);
}

function getPhotoNews($limit = 6) : array {
    return getNews('http://k.img.com.ua/rss/ru/mainbyday.xml', $limit);
}

function url($name, $params = []) {
    return Route::url($name, $params);
}

function printTemplateHtml($template, $arData = []) {
    /*global $smarty;
    $smarty->assign('arData', $arData);
    $smarty->display($template . '.tpl');*/
    $template_path = $_SERVER['DOCUMENT_ROOT'] . '/include/template/' . $template . '.php';
    if(is_file($template_path)) {
        include $template_path;
    }
}

function includeBlock($block) {
    $block_path = $_SERVER['DOCUMENT_ROOT'] . '/include/blocks/' . $block . '.php';
    if(is_file($block_path)) {
        include $block_path;
    }
}

function db_connect() {
    return DbConnection::get();
}

function redirect($url, $status = 301) {
    header("Location: " . $url, true, $status);
    exit;
}
