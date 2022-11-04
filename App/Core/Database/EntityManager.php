<?php

declare(strict_types = 1);

namespace App\Core\Database;

use PDO;
use App\User;
use App\Entity;
use App\JourneyType;
use App\Core\Database\Operations\Delete;
use App\Core\Database\Operations\OperationsFactory;

class EntityManager
{
    private const DB_HOST = 'taxi-db';
    private const DB_NAME = 'taxi';
    private const DB_USER = 'taxi_login';
    private const DB_PASS = 'taxi_password';

    private PDO $db;

    // todo отдельный файл
    private array $tablesMapping = [
        User::class => 'users',
        JourneyType::class => 'journey_types',
    ];

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

        $table = $this->tablesMapping[$entity::class];
        $this->query = (new OperationsFactory())->build($entity, $table);

        foreach ($entityProperties as $property) {
            $propertyName = $property->getName();
            $mappingKey = ':' . $propertyName;

            if (is_null($entity->{$propertyName}))
                continue;
            if (gettype($entity->{$propertyName}) === 'boolean') {
                $this->params[$mappingKey] = (int) $entity->{$propertyName};
                continue;
            }

            $this->params[$mappingKey] = $entity->{$propertyName};
        }
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