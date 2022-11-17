<?php

use App\Core\Routing\Router;

$router = Router::getInstance();

$router->get('/sign_in', 'UserController@showAuthForm');
$router->post('/sign_in', 'UserController@authorization');

//$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
