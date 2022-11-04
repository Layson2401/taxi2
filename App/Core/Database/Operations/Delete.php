<?php

declare(strict_types=1);

namespace App\Core\Database\Operations;

class Delete
{
    public function build(string $table): string
    {
        return "DELETE FROM " . $table . " WHERE " . "id=:id";
    }

}