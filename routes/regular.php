<?php

use App\Core\Routing\Router;

Router::get('/sign_in', 'UserController@showAuthForm');
Router::post('/sign_in', 'UserController@authorization');

Router::get('/registration', 'UserController@showRegForm');
Router::post('/registration', 'UserController@registration');
