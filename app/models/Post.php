<?php

namespace App\Models;

use App\Models\Traits\DB;
use App\Models\Traits\Model;

class Post
{
    use Model, DB;

    private const TABLE = "posts";

    private string|null $title = null;
    private string|null $content = null;
    private int|null $user_id = null;

    public function __construct()
    {
    }

    public function getTitle(): string|null
    {
        return $this->title;
    }

    public function getContent(): string|null
    {
        return $this->content;
    }

    public function getUser_id(): int|null
    {
        return $this->user_id;
    }

    public function getUser(): bool|object
    {
        return User::one(["id" => $this->user_id]);
    }
}
