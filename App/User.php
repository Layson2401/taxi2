<?php

namespace App;

// request, response, data mapper, active record
class User extends Entity
{
    public function __construct(
        public ?int $id,
        public string $login,
        public string $password,
        public string $email,
        public bool $isActive,
        public ?int $roleId = null,
        public ?string $authKey = null,
    ) {
    }
}