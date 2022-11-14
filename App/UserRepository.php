<?php

namespace App;

use PDO;

class UserRepository
{

    private PDO $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=taxi-db;dbname=taxi', 'taxi_login', 'taxi_password');
    }

    public function all(): array
    {
        $users = [];

        $stmt = $this->db->query("SELECT * FROM users");
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            $users[] = new User(
                $row['id'],
                $row['login'],
                $row['password'],
                $row['email'],
                $row['is_active'],
            );;
        }

        return $users;
    }

    public function getById(int $id): User
    {
        $query = "SELECT * FROM users WHERE `id` = ?";
        $params = [$id];
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        $row = $stmt->fetch(PDO::FETCH_LAZY);
        return new User($row['id'], $row['login'], $row['password'], $row['email'], $row['is_active']);
    }

    public function getByEmail(string $email)
    {
        $query = "SELECT * FROM users WHERE `email` = ?";
        $params = [$email];
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        $row = $stmt->fetch(PDO::FETCH_LAZY);
        return new User($row['id'], $row['login'], $row['password'], $row['email'], $row['is_active']);
    }
}


// primitives: string, int, decimal, bool
// complex: object