<?php

//declare(strict_types=1);

namespace App\Core\Database;

use App\Core\Database\Operations\Delete;
use App\Core\Database\Operations\OperationsFactory;
use App\Entity;
use App\JourneyType;
use App\User;
use PDO;
use ReflectionProperty;

class EntityManager
{
    private PDO $db;
    private array $tablesMapping = [
        User::class => "users",
        JourneyType::class => "journey_types"
    ];
    private array $params = [];
    private string $query;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=taxi-db;dbname=taxi', 'taxi_login', 'taxi_password');
    }

    public function persist(Entity $entity): void
    {
        $entityProperties = (new \ReflectionClass($entity))->getProperties();

        $table = $this->tablesMapping[$entity::class];
        $this->query = (new OperationsFactory())->build($entity, $table);

        foreach ($entityProperties as $property) {
            $propertyName = $property->getName();
            $mappingKey = ':' . $propertyName;

            if (is_null($entity->{$propertyName}))
                continue;
            if (gettype($entity->{$propertyName}) == "boolean") {
                $this->params[$mappingKey] = (int) $entity->{$propertyName};
                continue;
            }

            $this->params[$mappingKey] = $entity->{$propertyName};
        }
//        $this->params = [
//            ':login' => $entity->login,
//            ':password' => $entity->password,
//            ':email' => $entity->email,
//            ':is_active' => (int)$entity->isActive,
//            ':id' => $entity->id
//        ];
    }

    public function delete(Entity $entity): void
    {
        $table = $this->tablesMapping[$entity::class];
        $this->query = (new Delete())->build($table);
        $this->params = [
            ':id' => $entity->id
        ];
    }

    public function run(): void
    {
        $stmt = $this->db->prepare($this->query);
        $stmt->execute($this->params);
    }
}