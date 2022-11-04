<?php

declare(strict_types=1);

namespace App\Core\Database\Operations;

use App\Entity;

class OperationsFactory
{
    public function build(Entity $entity, string $table): string
    {

        return $entity->id != null
            ? (new Update())->build($entity, $table)
            : (new Insert())->build($entity, $table);
    }
}