<?php

namespace App\Core\Routing;

class Router
{
    private static array $instances = [];

    private array $routes = [
    ];

    protected function __construct() { }

    /**
     * Одиночки не должны быть клонируемыми.
     */
    protected function __clone() { }

    /**
     * Одиночки не должны быть восстанавливаемыми из строк.
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    /**
     * Это статический метод, управляющий доступом к экземпляру одиночки. При
     * первом запуске, он создаёт экземпляр одиночки и помещает его в
     * статическое поле. При последующих запусках, он возвращает клиенту объект,
     * хранящийся в статическом поле.
     *
     * Эта реализация позволяет вам расширять класс Одиночки, сохраняя повсюду
     * только один экземпляр каждого подкласса.
     */
    public static function getInstance(): Router
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function dispatch(string $method, string $url)
    {
        $authKey = $_COOKIE['auth_key'] ?? null;

        if (!$authKey && $_SERVER['REQUEST_URI'] !== '/sign_in') {
            (new Response())->redirect('/sign_in');
        }
        // проверка роли и редирект на авторизацию
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['url'] === $url) {

                $request = new Request($method, $url);

                [$action, $controllerInstance] = $this->buildController($route['action']);

                $controllerInstance->$action($request);
                exit();
            }
        }

        foreach ($this->routes as $route) {
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

    public function get(string $url, string $controller): void
    {
        $this->routes[] = [
            'method' => 'GET',
            'url' => $url,
            'action' => $controller
        ];
    }

    public function post(string $url, string $controller)
    {
        $this->routes[] = [
            'method' => 'POST',
            'url' => $url,
            'action' => $controller
        ];
    }

    public function delete(string $url, string $controller)
    {
        $this->routes[] = [
            'method' => 'DELETE',
            'url' => $url,
            'action' => $controller
        ];

    }

    public function put(string $url, string $controller)
    {
        $this->routes[] = [
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
