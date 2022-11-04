<?php

namespace App\Core\Database\Operations;

use App\Entity;

class Insert
{

//            $this->query = "INSERT INTO users (login, password, email, is_active) VALUES (:login, :password, :email, :is_active)";
    public function build(Entity $entity, string $table): string
    {
        $entityProperties = (new \ReflectionClass($entity))->getProperties();
        array_shift($entityProperties);

        $var = "";
        $values = "";

        foreach ($entityProperties as $property) {
            $propertyName = camelToUnderscore($property->getName());
            $var .= $propertyName . ', ';
            $values .= ":$propertyName, ";
        }
        $var = substr($var, 0, -2);
        $values = substr($values, 0, -2);

        return "INSERT INTO {$table} ({$var}) VALUES ({$values})";
    }
}