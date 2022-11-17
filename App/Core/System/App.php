<?php

namespace App\Core\System;

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
//$router = new Router();
//
//$router->get('/sign_in', 'UserController@showAuthForm');
//$router->post('/sign_in', 'UserController@authorization');
//
//$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

