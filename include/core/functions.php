<?php

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

function isAuthorizedUser(): bool {
    return isset($_SESSION['user']['id']) && $_SESSION['user']['id'] > 0;
}

function loginUser($email, $password): bool {

    $result = false;

    $link = db_connect();

    $query = "SELECT id, name, email, password FROM users WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    $res = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($res)) {
        $hash = $row['password'];
        if(password_verify($password, $hash)) {
            $_SESSION = [
                'user' => [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                ],
            ];
            $result = true;
        }
    }

    return $result;

}

function logoutUser() {
    if(isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }
}


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


function url($name, $params = []) {

    global $routes;

    $url = $routes[$name][1] ?? '';

    if(!empty($params)) {
        $arReplace = [];
        foreach ($params as $key => $value) {
            $arReplace['<' . $key . '>'] = $value;
        }
        if(!empty($arReplace)) {
            $url = str_replace(array_keys($arReplace), $arReplace, $url);
        }
    }
    return $url;
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
    $link = mysqli_connect('localhost', 'root', '', 'skillup');
    if (mysqli_connect_errno()) {
        echo "Не удалось подключиться к MySQL: " . mysqli_connect_error();
        exit;
    }
    return $link;
}

function getUserList() {
    $link = db_connect();
    $query = "SELECT id, name, email, password, age, gender, is_admin FROM users ORDER BY id DESC";
    $result = mysqli_query($link, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function getUserItem(int $id) {
    $arUser = [];
    $link = db_connect();
    $query = "SELECT id, name, email, password, age, gender, is_admin FROM users WHERE id = " . $id;
    $result = mysqli_query($link, $query);
    if($row = mysqli_fetch_assoc($result)) {
        $arUser = $row;
    }
    return $arUser;
}


function updateUser(int $id, string $name, string $email, int $is_admin, string $password = '') {
    $link = db_connect();
    $query = "
        UPDATE users
        SET
            name = '" . $name . "',
            email = '" . $email . "',
            is_admin = " . $is_admin . "
        WHERE id = {$id}
    ";
    $result = mysqli_query($link, $query);
    if($password != '') {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = '" . $hash . "' WHERE id = {$id}";
        mysqli_query($link, $query);
    }
    return (bool)$result;
}


function addUser(string $name, string $email, int $is_admin, string $password) {
    $link = db_connect();
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "
        INSERT INTO users
        SET
            name = '" . $name . "',
            email = '" . $email . "',
            is_admin = " . $is_admin . ",
            password = '" . $hash . "'
    ";
    $result = mysqli_query($link, $query);
    return (bool)$result;
}


function deleteUser(int $id) {
    $link = db_connect();
    $query = "DELETE FROM users WHERE id = {$id}";
    $result = mysqli_query($link, $query);
    return (bool)$result;
}