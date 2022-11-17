<?php

use App\Core\Routing\Router;
use App\Core\Routing\RoutesOperator;

class App {
    public function registerRoutes(): Router
    {
        $router = Router::getInstance();
        $subDomain = (new RoutesOperator())->extractSubDomain($_SERVER['HTTP_HOST']);

        $fileName = "routes/{$subDomain}.php";

        include $fileName;

        return $router;
    }
}

