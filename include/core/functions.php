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
    return $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $entity . '/' . $file_name;
}

function deleteEntityImage($entity, $file_name) {
    $file_path = getEntityImage($entity, $file_name);
    if(is_file($file_path)) {
        unlink($file_path);
    }
}

/* USERS */
function getUserList() {
    $link = db_connect();
    $query = "SELECT id, name, email, password, is_admin FROM users ORDER BY id DESC";
    $result = mysqli_query($link, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function getUserItem(int $id) {
    $arUser = [];
    $link = db_connect();
    $query = "SELECT id, name, email, password, is_admin FROM users WHERE id = " . $id;
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
/* USERS END */

/* CATEGORIES */
function getCategoriesList() {
    $link = db_connect();
    $query = "SELECT id, name, parent_id FROM categories ORDER BY id";
    $result = mysqli_query($link, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getCategoriesTree($parent_id = 0, $max_level = 0, $current_level = 0) {
    $arCategories = getCategoriesList();
    $arResult = [];
    foreach ($arCategories as $arCategory) {
        if($parent_id == $arCategory['parent_id']) {
            $arResult[$arCategory['id']] = $arCategory;
            if($max_level == 0 || $max_level > $current_level) {
                $arResult[$arCategory['id']]['children'] = getCategoriesTree($arCategory['id'], $max_level, $current_level + 1);
            }
        }
    }
    return $arResult;
}

function getCategoriesListStructured($parent_id = 0, $max_level = 0, $current_level = 0) {
    $arCategories = getCategoriesList();
    $arResult = [];
    foreach ($arCategories as $arCategory) {
        if($parent_id == $arCategory['parent_id']) {
            $arResult[$arCategory['id']] = $arCategory;
            $arResult[$arCategory['id']]['level'] = $current_level;
            if($max_level == 0 || $max_level > $current_level) {
                $arResult = array_merge($arResult, getCategoriesListStructured($arCategory['id'], $max_level, $current_level + 1));
            }
        }
    }
    return $arResult;
}

function getCategoryItem(int $id) {
    $arData = [];
    $link = db_connect();
    $query = "SELECT id, name, parent_id FROM categories WHERE id = " . $id;
    $result = mysqli_query($link, $query);
    if($row = mysqli_fetch_assoc($result)) {
        $arData = $row;
    }
    return $arData;
}


function updateCategory(int $id, string $name, int $parent_id) {
    $link = db_connect();
    $query = "
        UPDATE categories
        SET
            name = '" . $name . "',
            parent_id = " . ($parent_id > 0 ? $parent_id : 'NULL') . "
        WHERE id = {$id}
    ";
    $result = mysqli_query($link, $query);
    return (bool)$result;
}


function addCategory(string $name, int $parent_id) {
    if($image = saveEntityImage('category', 'image')) {
        $link = db_connect();
        $query = "
            INSERT INTO categories
            SET
                name = '" . $name . "',
                parent_id = " . ($parent_id > 0 ? $parent_id : 'NULL') . ",
                image = '" . $image . "'
        ";
        if(!($result = mysqli_query($link, $query))) {
            deleteEntityImage('category', $image);
        }
    }
    return (bool)$result;
}


function deleteCategory(int $id) {
    $link = db_connect();
    $query = "DELETE FROM categories WHERE id = {$id}";
    $result = mysqli_query($link, $query);
    return (bool)$result;
}
/* CATEGORIES END */

/* INGREDIENTS */
function getIngredientsList() {
    $link = db_connect();
    $query = "SELECT id, name FROM ingredients ORDER BY name";
    $result = mysqli_query($link, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function getIngredientItem(int $id) {
    $arData = [];
    $link = db_connect();
    $query = "SELECT id, name FROM ingredients WHERE id = " . $id;
    $result = mysqli_query($link, $query);
    if($row = mysqli_fetch_assoc($result)) {
        $arData = $row;
    }
    return $arData;
}


function updateIngredient(int $id, string $name) {
    $link = db_connect();
    $query = "
        UPDATE ingredients
        SET
            name = '" . $name . "'
        WHERE id = {$id}
    ";
    $result = mysqli_query($link, $query);
    return (bool)$result;
}


function addIngredient(string $name) {
    $link = db_connect();
    $query = "
        INSERT INTO ingredients
        SET
            name = '" . $name . "'
    ";
    $result = mysqli_query($link, $query);
    return (bool)$result;
}


function deleteIngredient(int $id) {
    $link = db_connect();
    $query = "DELETE FROM ingredients WHERE id = {$id}";
    $result = mysqli_query($link, $query);
    return (bool)$result;
}
/* INGREDIENTS END */

/* RECIPES */
function getRecipesList() {
    $link = db_connect();
    $query = "SELECT id, name, description, image, user_id, date FROM recipes ORDER BY id DESC";
    $result = mysqli_query($link, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function getRecipeItem(int $id) {
    $arData = [];
    $link = db_connect();
    $query = "SELECT id, name, description, image, user_id, date FROM recipes WHERE id = " . $id;
    $result = mysqli_query($link, $query);
    if($row = mysqli_fetch_assoc($result)) {
        $arData = $row;
    }
    return $arData;
}


function updateRecipe(int $id, string $name, string $description, int $user_id, string $date) {
    $link = db_connect();
    $query = "
        UPDATE recipes
        SET 
            name = '{$name}',
            description = '{$description}',
            user_id = " . ($user_id > 0 ? $user_id : 'NULL') . ",
            date = '{$date}'
        WHERE id = {$id}
    ";
    $result = mysqli_query($link, $query);
    return (bool)$result;
}


function addRecipe(string $name, string $description, int $user_id, string $date) {
    $link = db_connect();
    $query = "
        INSERT INTO recipes
        SET
            name = '{$name}',
            description = '{$description}',
            user_id = " . ($user_id > 0 ? $user_id : 'NULL') . ",
            date = '{$date}'
    ";
    $result = mysqli_query($link, $query);
    return (bool)$result;
}


function deleteRecipe(int $id) {
    $link = db_connect();
    $query = "DELETE FROM recipes WHERE id = {$id}";
    $result = mysqli_query($link, $query);
    return (bool)$result;
}
/* RECIPES END */