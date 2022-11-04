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

    public function add(User $user)
    {
        $query = "INSERT INTO users (login, password, email, is_active) VALUES (:login, :password, :email, :is_active)";
        $params = [
            ':login' => $user->login,
            ':password' => $user->password,
            ':email' => $user->email,
            ':is_active' => $user->isActive
        ];
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
    }

    public function update(int $id, User $user)
    {
        $query = "UPDATE users SET login=?, password=?, email=?, is_active=? WHERE id=?";
        $params = [
            $user->login,
            $user->password,
            $user->email,
            (int)$user->isActive,
            $id
        ];
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM `users` WHERE `id` = ?";
        $params = [$id];
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
    }

    public function all(): array
    {
        $users = [];

        $stmt = $this->db->query("SELECT * FROM users");
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            $user = new User($row['id'], $row['login'], $row['password'], $row['email'], $row['is_active']);
            $users[] = $user;
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
}


// primitives: string, int, decimal, bool
// complex: object