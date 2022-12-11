<?php

namespace App\Core\Routing;

use App\Route;
use App\Core\System\Singleton;

class Router extends Singleton
{
    public static array $routes = [
    ];

    public function dispatch(string $method, string $url)
    {
        $authKey = $_COOKIE['auth_key'] ?? null;

        if (!$authKey &&
            $_SERVER['REQUEST_URI'] !== '/sign_in' &&
            $_SERVER['REQUEST_URI'] !== '/registration') {
            (new Response())->redirect('/sign_in');
        }
        // проверка роли и редирект на авторизацию
        foreach (self::$routes as $route) {
            if ($route->getMethod() === $method && $route->getUrl() === $url) {

                $request = new Request($method, $url);

                [$action, $controllerInstance] = $this->buildController($route->getAction());

                $controllerInstance->$action($request);
                exit();
            }
        }

        foreach (self::$routes as $route) {
            $expression = (new Expression())->build($route->getUrl());

            if ($route->getMethod() === $method && preg_match($expression, $url)) {
                $request = new Request($method, $url);
                $this->appendRouteParametersToRequest($request, $route);

                [$action, $controllerInstance] = $this->buildController($route->getAction());
                $controllerInstance->$action($request);
            }
        }
    }

    private function appendRouteParametersToRequest(Request $request, Route $route): void
    {
        (new RouteParametersExtractor())->extract($request, $route);
    }

    public static function get(string $url, string $controller): void
    {
        self::$routes[] = new Route($url, 'GET', $controller);
//        self::$routes[] = [
//            'method' => 'GET',
//            'url' => $url,
//            'action' => $controller,
//        ];
    }

    public static function post(string $url, string $controller)
    {
        self::$routes[] = new Route($url, 'POST', $controller);


    }

    public static function delete(string $url, string $controller)
    {
        self::$routes[] = new Route($url, 'DELETE', $controller);

    }

    public static function put(string $url, string $controller)
    {
        self::$routes[] = new Route($url, 'PUT', $controller);
    }

    public function buildController(string $action): array
    {
        [$controller, $action] = explode("@", $action);
        $fullControllerName = '\\App\\Http\\' . $controller;
        $controllerInstance = new $fullControllerName();

        return [$action, $controllerInstance];
    }
//
//    /**
//     * @return string
//     */
//    public function getMethod(): string
//    {
//        return $this->method;
//    }

}
