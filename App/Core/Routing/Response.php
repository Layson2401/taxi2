<?php

namespace App\Core\Routing;

class Response
{
    public function redirect(string $url):void
    {
        header('Location: ' . $url);
    }

}