<?php

namespace App\Core\Routing;

use App\Core\System\Singleton;

class Router extends Singleton
{
    public static array $routes = [
    ];

    public function dispatch(string $method, string $url)
    {
//        echo '<pre>';
//        var_dump(self::$routes);
//        echo "</pre>";
        $authKey = $_COOKIE['auth_key'] ?? null;

        if (!$authKey &&
            $_SERVER['REQUEST_URI'] !== '/sign_in' &&
            $_SERVER['REQUEST_URI'] !== '/registration') {
            (new Response())->redirect('/sign_in');
        }
        // проверка роли и редирект на авторизацию
        foreach (self::$routes as $route) {
            if ($route['method'] === $method && $route['url'] === $url) {

                $request = new Request($method, $url);

                [$action, $controllerInstance] = $this->buildController($route['action']);

                $controllerInstance->$action($request);
                exit();
            }
        }

        foreach (self::$routes as $route) {
            $expression = (new Expression())->build($route['url']);

            if ($route['method'] === $method && preg_match($expression, $url)) {
                $request = new Request($method, $url);
                $this->appendRouteParametersToRequest($request, $route);

                [$action, $controllerInstance] = $this->buildController($route['action']);
                $controllerInstance->$action($request);
            }
        }
    }

    private function appendRouteParametersToRequest(Request $request, array $route): void
    {
        (new RouteParametersExtractor())->extract($request, $route);
    }

    public static function get(string $url, string $controller): void
    {
        self::$routes[] = [
            'method' => 'GET',
            'url' => $url,
            'action' => $controller
        ];
    }

    public static function post(string $url, string $controller)
    {
        self::$routes[] = [
            'method' => 'POST',
            'url' => $url,
            'action' => $controller
        ];
    }

    public static function delete(string $url, string $controller)
    {
        self::$routes[] = [
            'method' => 'DELETE',
            'url' => $url,
            'action' => $controller
        ];

    }

    public static function put(string $url, string $controller)
    {
        self::$routes[] = [
            'method' => 'PUT',
            'url' => $url,
            'action' => $controller
        ];

    }

    public function buildController(string $action): array
    {
        [$controller, $action] = explode("@", $action);
        $fullControllerName = '\\App\\Http\\' . $controller;
        $controllerInstance = new $fullControllerName();

        return [$action, $controllerInstance];
    }

}
