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

        $query = "INSERT INTO " . $table . " (";
        $var = "";

        foreach ($entityProperties as $property) {
            $var = $var . $property->getName() . ", ";
        }

        $query = substr($query . camelToUnderscore($var), 0, -2) . ") VALUES (";
        $var = "";

        foreach ($entityProperties as $property) {
            $var = $var . ":" . $property->getName() . ", ";
        }

        return substr($query . $var, 0, -2) . ")";
    }
}