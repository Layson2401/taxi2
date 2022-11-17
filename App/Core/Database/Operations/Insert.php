<?php

namespace App\Core\Database\Operations;

use App\Entity;
use App\Core\System\Helper;

class Insert
{
    public function build(Entity $entity, string $table): string
    {
        $entityProperties = (new \ReflectionClass($entity))->getProperties();
        array_shift($entityProperties);

        $var = '';
        $values = '';

        foreach ($entityProperties as $property) {
            $propertyName = $property->getName();
            $var .= Helper::camelToUnderscore($propertyName) . ', ';
            $values .= ":$propertyName, ";
        }

        $var = substr($var, 0, -2);
        $values = substr($values, 0, -2);

        return "INSERT INTO {$table} ({$var}) VALUES ({$values})";
    }
}