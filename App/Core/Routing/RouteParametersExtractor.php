<?php

namespace App\Core\Routing;


use App\Route;

class RouteParametersExtractor
{
    public function extract(Request $request, Route $route): void
    {
        $routeWildCards = (new WildCardExtractor())->get($route->getUrl());

        $expression = (new Expression())->build($route->getUrl());


        preg_match_all($expression, $request->url, $routeParams, PREG_SET_ORDER);
        $matchedParams = $routeParams[0];
        array_shift($matchedParams);


        $request->setAttributes(array_combine($routeWildCards, $matchedParams));
    }

}