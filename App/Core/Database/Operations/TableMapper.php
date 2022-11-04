<?php

namespace App\Core\Database\Operations;

use App\Entity;
use App\JourneyType;
use App\User;


class TableMapper
{
    private array $tablesMapping = [
        User::class => 'users',
        JourneyType::class => 'journey_types',
    ];

    public function getTable(Entity $entity)
    {
        return $this->tablesMapping[$entity::class];
    }

}