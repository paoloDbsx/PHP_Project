<?php

namespace App\Models\Traits;

use Exception;

trait Model
{
    public function set(array $values): void
    {
        foreach ($values as $key => $value) {
            if ($key !== "id" && property_exists($this, $key)) {
                $this->$key = $value;
            } else {
                throw new \Exception("Clé invalide", 1);
            }
        }
    }

    public function getId(): mixed
    {
        if (property_exists($this, "id")) {
            return $this->id;
        } else {
            throw new \Exception("Cette instance n'a pas d'id", 1);
        }
    }
}
