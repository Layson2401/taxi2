<?php

namespace App\Core\Routing;


class RouteParametersExtractor
{
    public function extract(Request $request, array $route): void
    {
        $routeWildCards = (new WildCardExtractor())->get($route["url"]);

        $expression = (new Expression())->build($route["url"]);


        preg_match_all($expression, $request->url, $routeParams, PREG_SET_ORDER);
        $matchedParams = $routeParams[0];
        array_shift($matchedParams);


        $request->setAttributes(array_combine($routeWildCards, $matchedParams));
    }

}