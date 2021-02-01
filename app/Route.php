<?php


namespace App;


class Route
{
    public static $routes = [
        'main_page' => ['/', '/', 'index'],
        'news_list' => ['/news/', '/news/', 'news/list'],
        'news_detail' => ['/news/([0-9]+)-([0-9a-z-]+).html', '/news/<id>-<vvv_id>.html', 'news/detail'],
        'contacts' => ['/contacts/', '/contacts/', 'contacts/index'],
        'contacts_send_form' => ['/contacts/send/', '/contacts/send/', 'contacts/send'],

        'login' => ['/auth/', '/auth/', 'auth'],
        'logout' => ['/logout/', '/logout/', 'logout'],
        'profile' => ['/profile/', '/profile/', 'profile'],

        'admin_entity_list' => ['/admin/([a-z-]+)/', '/admin/<entity>/', 'admin/entity/handler'],
        'admin_entity_add' => ['/admin/([a-z-]+)/add/', '/admin/<entity>/add/', 'admin/entity/handler'],
        'admin_entity_create' => ['/admin/([a-z-]+)/create/', '/admin/<entity>/create/', 'admin/entity/handler'],
        'admin_entity_update' => ['/admin/([a-z-]+)/update/', '/admin/<entity>/update/', 'admin/entity/handler'],
        'admin_entity_edit' => ['/admin/([a-z-]+)/edit/([0-9]+)/', '/admin/<entity>/edit/<id>/', 'admin/entity/handler'],
        'admin_entity_delete' => ['/admin/([a-z-]+)/delete/([0-9]+)/', '/admin/<entity>/delete/<id>/', 'admin/entity/handler'],

        'admin_users' => ['/admin/users/', '/admin/users/', 'admin/users/list'],
        'admin_users_add' => ['/admin/users/add/', '/admin/users/add/', 'admin/users/add'],
        'admin_users_create' => ['/admin/users/create/', '/admin/users/create/', 'admin/users/create'],
        'admin_users_update' => ['/admin/users/update/', '/admin/users/update/', 'admin/users/update'],
        'admin_users_edit' => ['/admin/users/edit/([0-9]+)/', '/admin/users/edit/<id>/', 'admin/users/edit'],
        'admin_users_delete' => ['/admin/users/delete/([0-9]+)/', '/admin/users/delete/<id>/', 'admin/users/delete'],

        'admin_categories' => ['/admin/categories/', '/admin/categories/', 'admin/categories/list'],
        'admin_categories_add' => ['/admin/categories/add/', '/admin/categories/add/', 'admin/categories/add'],
        'admin_categories_create' => ['/admin/categories/create/', '/admin/categories/create/', 'admin/categories/create'],
        'admin_categories_update' => ['/admin/categories/update/', '/admin/categories/update/', 'admin/categories/update'],
        'admin_categories_edit' => ['/admin/categories/edit/([0-9]+)/', '/admin/categories/edit/<id>/', 'admin/categories/edit'],
        'admin_categories_delete' => ['/admin/categories/delete/([0-9]+)/', '/admin/categories/delete/<id>/', 'admin/categories/delete'],

        'admin_ingredients' => ['/admin/ingredients/', '/admin/ingredients/', 'admin/ingredients/list'],
        'admin_ingredients_add' => ['/admin/ingredients/add/', '/admin/ingredients/add/', 'admin/ingredients/add'],
        'admin_ingredients_create' => ['/admin/ingredients/create/', '/admin/ingredients/create/', 'admin/ingredients/create'],
        'admin_ingredients_update' => ['/admin/ingredients/update/', '/admin/ingredients/update/', 'admin/ingredients/update'],
        'admin_ingredients_edit' => ['/admin/ingredients/edit/([0-9]+)/', '/admin/ingredients/edit/<id>/', 'admin/ingredients/edit'],
        'admin_ingredients_delete' => ['/admin/ingredients/delete/([0-9]+)/', '/admin/ingredients/delete/<id>/', 'admin/ingredients/delete'],

        'admin_recipes' => ['/admin/recipes/', '/admin/recipes/', 'admin/recipes/list'],
        'admin_recipes_add' => ['/admin/recipes/add/', '/admin/recipes/add/', 'admin/recipes/add'],
        'admin_recipes_create' => ['/admin/recipes/create/', '/admin/recipes/create/', 'admin/recipes/create'],
        'admin_recipes_update' => ['/admin/recipes/update/', '/admin/recipes/update/', 'admin/recipes/update'],
        'admin_recipes_edit' => ['/admin/recipes/edit/([0-9]+)/', '/admin/recipes/edit/<id>/', 'admin/recipes/edit'],
        'admin_recipes_delete' => ['/admin/recipes/delete/([0-9]+)/', '/admin/recipes/delete/<id>/', 'admin/recipes/delete'],
    ];

    // роуты, для которых не нужны шапка и подвал
    private static $arRoutesWithoutHeaderAndFooter = [
        'contacts_send_form',
        'logout',
        'admin_entity_create', 'admin_entity_update', 'admin_entity_delete',
        'admin_users_delete', 'admin_users_create', 'admin_users_update',
        'admin_categories_create', 'admin_categories_update', 'admin_categories_delete',
        'admin_ingredients_create', 'admin_ingredients_update', 'admin_ingredients_delete',
        'admin_recipes_create', 'admin_recipes_update', 'admin_recipes_delete',
    ];

    public static function get($path = '') {

        if($path == '') {
            $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }

        $arRoute = [
            'name' => '',
            'page' => '404',
            'param' => [],
        ];

        foreach (self::$routes as $name => $arValue) {
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

                break;

            }
        }

        return $arRoute;
    }

    public static function needHeaderFooter($route_name) {
        return !in_array($route_name, self::$arRoutesWithoutHeaderAndFooter);
    }
}