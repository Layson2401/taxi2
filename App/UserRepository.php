<?php

declare(strict_types=1);

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
                (int) $row['id'],
                $row['login'],
                $row['password'],
                $row['email'],
                (bool) $row['is_active'],
                (int) $row['role_id'],
            );
        }

        return $users;
    }

    public function getById(int $id): User
    {
        $query = "SELECT * FROM users WHERE `id` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_LAZY);

        return new User(
            (int) $row['id'],
            $row['login'],
            $row['password'],
            $row['email'],
            (bool) $row['is_active'],
            (int) $row['role_id'],
        );
    }

    public function getByEmail(string $email): User
    {
        $query = "SELECT * FROM users WHERE `email` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_LAZY);

        return new User(
            (int) $row['id'],
            $row['login'],
            $row['password'],
            $row['email'],
            (bool) $row['is_active'],
            (int) $row['role_id'],
        );
    }
}