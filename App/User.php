<?php

namespace App;


// request, response, data mapper, active record
class User extends Entity
{
    public ?int $id;
    public string $login;
    public string $password;
    public string $email;
    public bool $isActive;

    public function __construct(?int $id, string $login, string $password, string $email, bool $isActive)
    {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->isActive = $isActive;
    }


}