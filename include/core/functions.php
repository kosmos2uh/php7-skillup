<?php

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

function isAuthorizedUser(): bool {
    return isset($_SESSION['user']['id']) && $_SESSION['user']['id'] > 0;
}

function loginUser($email, $password): bool {

    $result = false;

    $link = db_connect();

    $query = "SELECT id, name, email, password, is_admin FROM users WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($res && $row = mysqli_fetch_assoc($res)) {
        $hash = $row['password'];
        if(password_verify($password, $hash)) {
            $_SESSION = [
                'user' => [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'is_admin' => $row['is_admin'],
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

function isAdminRoute() {
    global $arRoute;
    return strpos($arRoute['name'], 'admin_') === 0;
}

function isAdminUser() {
    $result = false;
    if(isAuthorizedUser()) {
        if($_SESSION['user']['is_admin'] == 1) {
            $result = true;
        }
    }
    return $result;
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
    $link = mysqli_connect('localhost', 'root', '', 'skillup');
    if (mysqli_connect_errno()) {
        echo "Не удалось подключиться к MySQL: " . mysqli_connect_error();
        exit;
    }
    return $link;
}

function redirect($url, $status = 301) {
    header("Location: " . $url, true, $status);
    exit;
}

function translit($string, $replacement = '-') {
    $string = mb_strtolower($string, 'utf-8');
    $from = array('ї','Ї','є','Є','ю','Ю','я','Я','ё','Ё','э','Э','ы','Ы','ж','Ж','й','Й','щ','Щ','ш','Ш','ч','Ч','х','Х',
        'а','А','б','Б','в','В','г','Г','д','Д','е','Е','з','З','и','И','к','К','л','Л','м','М','н','Н','о','О',
        'п','П','р','Р','с','С','т','Т','у','У','ф','Ф','х','Х','ц','Ц','Ь','ь','ъ','Ъ',
        'ґ', 'Ґ', 'є', 'Є', 'і', 'І', 'ї', 'Ї');

    $to = array('jy', 'Jy', 'je', 'Je', 'yu', 'Yu', 'ya', 'Ya', 'yo', 'Yo', 'e',  'E',  'y',  'Y',  'zh', 'Zh', 'j',  'J',  'sch','Sch','sh', 'Sh', 'ch', 'Ch', 'h',  'H',
        'a',  'A',  'b',  'B',  'v',  'V',  'g',  'G',  'd',  'D',  'e',  'E',  'z',  'Z',  'i',  'I',  'k',  'K',  'l',  'L',  'm',  'M',  'n',  'N',  'o',  'O',
        'p',  'P',  'r',  'R',  's',  'S',  't',  'T',  'u',  'U',  'f',  'F',  'h',  'H',  'c',  'C',  "",  "",  "",  "",
        'g', 'G', 'e', 'E', 'i', 'I', 'i', 'I');
    $string = str_replace($from, $to, $string);
    $string = preg_replace('/[^' . $replacement . '0-9a-zа-яёґєіїА-ЯЁҐЄІЇ]/i', ' ', $string);
    $string = preg_replace('/[' . $replacement . '\s]+/', $replacement, $string);
    return trim($string, $replacement);
}

function saveEntityImage($entity, $image_field_name) {
    $uploaded_file_name = '';
    if(!empty($_FILES[$image_field_name])) {
        $arFile = &$_FILES[$image_field_name];
        $ext = $arFile['type'] == 'image/png' ? 'png' : 'jpg';
        $originalFilename = pathinfo($arFile['name'], PATHINFO_FILENAME);
        $safeFilename = translit($originalFilename);
        $uniqid = uniqid();
        $subdir_name_1 = substr($uniqid, -4, -2);
        $subdir_name_2 = substr($uniqid, -2);
        $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $entity . '/' . $subdir_name_1 . '/' . $subdir_name_2 . '/';
        if(!is_dir($uploads_dir)) {
            mkdir($uploads_dir, '0777', true);
        }

        $fileName = $safeFilename . '-' . $uniqid . '.' . $ext;

        if(move_uploaded_file($arFile['tmp_name'], $uploads_dir . '/' . $fileName)) {
            $uploaded_file_name = $subdir_name_1 . '/' . $subdir_name_2 . '/' . $fileName;
        }
    }
    return $uploaded_file_name;
}

function getEntityImage($entity, $file_name) {
    $src = '';
    if($file_name != '') {
        $src = '/upload/' . $entity . '/' . $file_name;
    }
    return $src;
}

function deleteEntityImage($entity, $file_name) {
    $file_path = $_SERVER['DOCUMENT_ROOT'] . getEntityImage($entity, $file_name);
    if(is_file($file_path)) {
        unlink($file_path);
    }
}
