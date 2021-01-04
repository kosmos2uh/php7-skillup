<?php

$arNews = getPopularNews();

printTemplateHtml('right_popular_news', $arNews);