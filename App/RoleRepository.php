<?php

namespace App;

use PDO;

class RoleRepository
{

    private PDO $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=taxi-db;dbname=taxi', 'taxi_login', 'taxi_password');
    }

    public function getRoleName(int $roleId): string
    {
        $query = "SELECT code FROM roles WHERE `id` = {$roleId}";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_LAZY);
        return $row['code'];
    }

}