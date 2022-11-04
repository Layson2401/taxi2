<?php

namespace App\Core\Database\Operations;

use App\Entity;

class Update
{


    public function build(Entity $entity, string $table): string
    {
        $entityProperties = (new \ReflectionClass($entity))->getProperties();
        array_shift($entityProperties);

        $query = "UPDATE " . $table . " SET ";
        $var = "";

        foreach ($entityProperties as $property) {
            $var = $var . camelToUnderscore($property->getName()) . '=:' . $property->getName() . ', ';
        }

        return substr($query . $var, 0, -2) . " WHERE id=:id";


    }
//            $this->query = "UPDATE users SET $preparedQueryForUpdate WHERE id=:id";

}