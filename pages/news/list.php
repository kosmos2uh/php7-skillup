<?php
$arNews = getLastNews();
printTemplateHtml('news/index', [
    'news' => $arNews,
]);
