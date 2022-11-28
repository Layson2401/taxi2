<?php

declare(strict_types=1);

namespace App\Core\Routing;

class RoutesOperator
{
    public static function extractSubDomain(string $url): string
    {
        $domains = explode('.', $url);

        $subdomain = $domains[0];
        if (count($domains) === 2) {
            $subdomain = 'regular';
        }

        return $subdomain;
    }
}