<?php

declare(strict_types=1);

namespace App\Core\Database;

use PDO;
use App\Entity;
use App\Core\Database\Operations\Delete;
use App\Core\Database\Operations\TableMapper;
use App\Core\Database\Operations\OperationsFactory;

class EntityManager
{
    private const DB_HOST = 'taxi-db';
    private const DB_NAME = 'taxi';
    private const DB_USER = 'taxi_login';
    private const DB_PASS = 'taxi_password';

    private PDO $db;

    /**
     * @var array [:string => value]
     */
    private array $params = [];

    private string $query;

    public function __construct()
    {
        $this->db = new PDO(
            'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME,
            self::DB_USER,
            self::DB_PASS,
        );
    }

    public function persist(Entity $entity): void
    {
        $entityProperties = (new \ReflectionClass($entity))->getProperties();

        $table = (new TableMapper())->getTable($entity);
        $this->query = (new OperationsFactory())->build($entity, $table);

        foreach ($entityProperties as $property) {
            $propertyName = $property->getName();
            $mappingKey = ':' . $propertyName;

            if (is_null($entity->{$propertyName}))
                continue;

            if (is_bool($entity->{$propertyName})) {
                $this->params[$mappingKey] = (int)$entity->{$propertyName};
                continue;
            }

            $this->params[$mappingKey] = $entity->{$propertyName};
        }
    }

    public function delete(Entity $entity): void
    {
        $table = (new TableMapper())->getTable($entity);
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