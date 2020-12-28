<?php

function getNews($source, $limit) : array {

    $arNews = [];

    $xml = $source;
    $strXML = file_get_contents($xml);
    $objXML = simplexml_load_string($strXML, 'SimpleXMLElement', LIBXML_NOCDATA);
    $jsonXML = json_encode($objXML);
    $arXML = json_decode($jsonXML, true);

    foreach ($arXML['channel']['item'] as $item) {
        $arNews[] = [
            'id' => $item['guid'],
            'datetime' => date('H:i', strtotime($item['pubDate'])),
            'title' => $item['title'],
            'url' => '/detail.php?id=' . $item['guid'],
        ];
    }

    $arNews = array_slice($arNews, 0, $limit);

    return $arNews;
}

function getLastNews($limit = 20) : array {
    return getNews('http://k.img.com.ua/rss/ru/all_news2.0.xml', $limit);
}

function getPopularNew($limit = 10) : array {
    return getNews('http://k.img.com.ua/rss/ru/mainbyday.xml', $limit);
}