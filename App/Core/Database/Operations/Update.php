<?php

namespace App\Core\Database\Operations;

use App\Entity;

class Update
{
    public function build(Entity $entity, string $table): string
    {
        $entityProperties = (new \ReflectionClass($entity))->getProperties();
        array_shift($entityProperties);

        $var = '';

        foreach ($entityProperties as $property) {
            $propertyName = $property->getName();
            $var .= camelToUnderscore($propertyName) . '=:' . $propertyName . ', ';
        }

        $var = substr($var, 0, -2);

        return "UPDATE {$table} SET {$var} WHERE id=:id";
    }
}