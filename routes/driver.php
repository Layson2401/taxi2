<?php

use App\Core\Routing\Router;

Router::get('/sign_in', 'UserController@showAuthForm');
Router::post('/sign_in', 'UserController@authorization');

Router::get('/registration', 'UserController@showAuthForm');
Router::post('/registration', 'UserController@authorization');

