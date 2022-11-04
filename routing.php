<?php

use App\Core\Routing\Router;

$router = new Router();

$router->get("/users/{id}", "UserController@show");
$router->get("/users/{id}/edit", "UserController@edit");

$router->get("/users", "UserController@all");
$router->get("/users/create", "UserController@create");
$router->post("/users/{id}/update", "UserController@update");
$router->post("/users/add", "UserController@add");
$router->get("/users/{id}/delete", "UserController@delete");
$router->put("/users", "UserController@put");

$router->get("/journey_types", "JourneyTypeController@all");
$router->post("/journey_types", "JourneyTypeController@add");
$router->delete("/journey_types", "JourneyTypeController@delete");
$router->put("/journey_types", "JourneyTypeController@put");


$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
