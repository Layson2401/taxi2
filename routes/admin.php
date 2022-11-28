<?php

use App\Core\Routing\Router;

Router::get('/users/{id}', 'UserController@show');
Router::get('/users/{id}/edit', 'UserController@edit');

Router::get('/users', 'UserController@all');
Router::get('/users/create', 'UserController@create');
Router::post('/users/{id}/update', 'UserController@update');
Router::post('/users/add', 'UserController@add');
Router::get('/users/{id}/delete', 'UserController@delete');
Router::put('/users', 'UserController@put');

Router::get('/journey_types', 'JourneyTypeController@all');
Router::post('/journey_types', 'JourneyTypeController@add');
Router::delete('/journey_types', 'JourneyTypeController@delete');
Router::put('/journey_types', 'JourneyTypeController@put');

Router::get('/sign_in', 'UserController@showAuthForm');
Router::post('/sign_in', 'UserController@authorization');