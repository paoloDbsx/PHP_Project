<?php

namespace App\Models;

use App\Models\Traits\DB;
use App\Models\Traits\Model;

class User
{
    use Model, DB;

    private const TABLE = "users";

    private string|null $pseudo = null;
    private string|null $password = null;

    public function getPseudo(): string|null
    {
        return $this->pseudo;
    }

    public function getPassword(): string|null
    {
        return $this->password;
    }
}
