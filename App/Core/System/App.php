<?php

namespace App\Core\System;

use App\Core\Routing\Router;
use App\Core\Routing\RoutesOperator;

class App
{
    public function registerRoutes(): Router
    {
        $router = Router::getInstance();

        $subDomain = RoutesOperator::extractSubDomain($_SERVER['HTTP_HOST']);

        $fileName = "routes/{$subDomain}.php";

        include $fileName;

        return $router;
    }

    public function run(Router $router): void
    {
        $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
    }
}