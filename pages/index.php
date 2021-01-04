<?php

$arNews = getLastNews(10);

$arPhotoNews = getPhotoNews();

printTemplateHtml('index/index', [
    'news' => $arNews,
    'photo_news' => $arPhotoNews,
]);
