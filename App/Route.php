<?php

namespace App;

class Route
{

    public function __construct(
        private string $url,
        private string $method,
        private string $action,
    ) {
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getAction(): string
    {
        return $this->action;
    }
}