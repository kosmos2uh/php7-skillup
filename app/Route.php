<?php


namespace App;


class Route
{

    public string $name = '';
    public string $page = '404';
    public array $param = [];

    private static array $routes = [
        'main_page' => ['/', '/', 'index'],
        'news_list' => ['/news/', '/news/', 'news/list'],
        'news_detail' => ['/news/([0-9]+)-([0-9a-z-]+).html', '/news/<id>-<vvv_id>.html', 'news/detail'],
        'contacts' => ['/contacts/', '/contacts/', 'contacts/index'],
        'contacts_send_form' => ['/contacts/send/', '/contacts/send/', 'contacts/send'],
        'recipe_detail' => ['/recipe/([0-9]+)/', '/recipe/<id>/', 'recipe/detail'],

        'login' => ['/auth/', '/auth/', 'auth'],
        'logout' => ['/logout/', '/logout/', 'logout'],
        'profile' => ['/profile/', '/profile/', 'profile'],

        'admin_entity_list' => ['/admin/([a-z-]+)/', '/admin/<entity>/', 'admin/entity/handler'],
        'admin_entity_add' => ['/admin/([a-z-]+)/add/', '/admin/<entity>/add/', 'admin/entity/handler'],
        'admin_entity_create' => ['/admin/([a-z-]+)/create/', '/admin/<entity>/create/', 'admin/entity/handler'],
        'admin_entity_update' => ['/admin/([a-z-]+)/update/', '/admin/<entity>/update/', 'admin/entity/handler'],
        'admin_entity_edit' => ['/admin/([a-z-]+)/edit/([0-9]+)/', '/admin/<entity>/edit/<id>/', 'admin/entity/handler'],
        'admin_entity_delete' => ['/admin/([a-z-]+)/delete/([0-9]+)/', '/admin/<entity>/delete/<id>/', 'admin/entity/handler'],
    ];

    // роуты, для которых не нужны шапка и подвал
    private static array $arRoutesWithoutHeaderAndFooter = [
        'contacts_send_form',
        'logout',
        'admin_entity_create',
        'admin_entity_update',
        'admin_entity_delete',
    ];

    public function __construct($path = '')
    {
        $this->get($path);
    }

    private function get($path = '') {

        if($path == '') {
            $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }

        foreach (self::$routes as $name => $arValue) {
            $pattern = '/^' . str_replace('/', '\/', $arValue[0]) . '$/';
            if(preg_match($pattern, $path, $matches)) {

                $this->name = $name;
                $this->page = $arValue[2];

                if(count($matches) > 1) {
                    preg_match_all("/<(.+?)>/", $arValue[1], $matches2);

                    foreach ($matches2[1] as $key => $param_name) {
                        $this->param[$param_name] = $matches[$key + 1];
                    }
                }

                break;

            }
        }
    }

    public function needHeaderFooter(): bool
    {
        return !in_array($this->name, self::$arRoutesWithoutHeaderAndFooter);
    }

    public static function url($name, $params = []) {
        $url = self::$routes[$name][1] ?? '';

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

    public function isAdminRoute(): bool
    {
        return strpos($this->name, 'admin_') === 0;
    }
}