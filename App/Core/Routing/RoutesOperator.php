<?php

namespace App\Core\Routing;

class RoutesOperator
{
    public function getSubDomain(string $url): string
    {
        $domains = explode('.', $url);
        $domains = array_slice($domains, 0, -2);
        return implode(".", $domains);
    }
}