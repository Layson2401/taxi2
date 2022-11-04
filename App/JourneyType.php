<?php

namespace App;

class JourneyType extends Entity
{
    public ?int $id;
    public string $name;

    public function __construct(?int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }


}