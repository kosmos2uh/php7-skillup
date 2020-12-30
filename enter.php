<?php

$routes = [
    'main_page' => ['/', '/', 'index'],
    'news_list' => ['/news/', '/news/', 'news/index'],
    'news_detail' => ['/news/([0-9a-z-]+)/([0-9a-z-]+)/', '/news/<id>/<vvv_id>/', 'news/detail'],
];

function getRoute($path = ''): array {

    global $routes;

    if($path == '') {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    $arRoute = [
        'name' => '',
        'page' => '404',
        'param' => [],
    ];

    foreach ($routes as $name => $arValue) {
        $pattern = '/^' . str_replace('/', '\/', $arValue[0]) . '$/';
        if(preg_match($pattern, $path, $matches)) {

            $arRoute['name'] = $name;
            $arRoute['page'] = $arValue[2];

            if(count($matches) > 1) {
                preg_match_all("/<(.+?)>/", $arValue[1], $matches2);

                foreach ($matches2[1] as $key => $param_name) {
                    $arRoute['param'][$param_name] = $matches[$key + 1];
                }
            }

        }
    }

    return $arRoute;

}

$arRoute = getRoute();

// получаем путь к файлу
$page_file = $_SERVER['DOCUMENT_ROOT'] . '/pages/' . $arRoute['page'] . '.php';

// если файл существует, подключаем его
if(!is_file($page_file)) {
    $page_file = $_SERVER['DOCUMENT_ROOT'] . '/pages/404.php';
}
include $page_file;

