<?php

namespace App\Routing;

class Route
{
    public static array $routes = [];
    public static string $pathname;

    public static function get(string $pathname, callable|array $action): void
    {
        if (is_array($action) && count($action) != 2) {
            throw new \Exception("App\Routing\Route::get(): L'action doit être composée de deux éléments : [contrôleur, méthode]");
        }
        self::$routes[] = [
            'pathname' => $pathname,
            'action' => $action
        ];
    }

    public static function dispatch()
    {
        self::$pathname = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_URL);

        foreach (self::$routes as $route) {
            $pattern = str_replace('/', '\/', preg_replace('/\{([a-zA-Z0-9]+)\}/', '([a-zA-Z0-9]+)', $route['pathname']));
            if (preg_match("/^$pattern$/", self::$pathname, $matches)) {
                array_shift($matches);

                $action = $route['action'];
                if (is_array($action)) {
                    [$controller, $method] = $action;
                    return (new $controller)->$method(...$matches);
                }
                return $action(...$matches);
            }
        }

        view("errors/404", "404");
    }
}
