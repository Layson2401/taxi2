<?php

namespace App\Core\Routing;

class Router
{
    private $routes = [

    ];



    public function dispatch(string $method, string $url)
    {

        foreach ($this->routes as $route) {
            if ($route['method'] == $method && $route["url"] === $url) {

                $request = new Request($method, $url);

                [$action, $controllerInstance] = $this->buildController($route['action']);




                $controllerInstance->$action($request);
                exit();
            }
        }

        foreach ($this->routes as $route) {
            $expression = (new Expression())->build($route["url"]);

            if ($route['method'] == $method && preg_match($expression, $url)) {

                $request = new Request($method,  $url);
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

    /** @TODO MOVE TO CONTROLLER FACTORY */
    public function buildController(string $action): array
    {
        [$controller, $action] = explode("@", $action);
        $fullControllerName = '\\App\\Http\\' . $controller;
        $controllerInstance = new $fullControllerName();

        return [$action, $controllerInstance];
    }

}
