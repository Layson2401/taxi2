<?php

namespace App;

use PDO;

class JourneyTypeRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=taxi-db;dbname=taxi', 'taxi_login', 'taxi_password');
    }

    public function add(JourneyType $journeyType)
    {
        $query = "INSERT INTO `journey_types` (`name`) VALUES (:name)";
        $params = [
            ':name' => $journeyType->name,
        ];
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
    }

    public function update(int $id, JourneyType $journeyType)
    {
        $query = "UPDATE `journey_types` SET name=? WHERE `id`=?";
        $params = [
            $journeyType->name,
            $id
        ];
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM `journey_types` WHERE `id`=?";
        $params = [$id];
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
    }

    public function all(): array
    {
        $journeyTypes = [];

        $stmt = $this->db->query("SELECT * FROM journey_types");
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            $journeyType = new JourneyType($row['id'], $row['name']);
            $journeyTypes[] = $journeyType;
        }
        return $journeyTypes;
    }

}