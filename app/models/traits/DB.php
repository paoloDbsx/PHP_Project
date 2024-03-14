<?php

namespace App\Models\Traits;

use PDO;

trait DB
{
    protected static PDO $pdo;

    protected static function connection(): void
    {
        if (!isset(self::$pdo)) {
            $dotenv = parse_ini_file('../.env');
            static::$pdo = new PDO(
                "{$dotenv['DB_CONNECTION']}:dbname={$dotenv['DB_NAME']};host={$dotenv['DB_HOST']}",
                "{$dotenv['DB_USERNAME']}",
                "{$dotenv['DB_PASSWORD']}"
            );
        }
    }

    public static function all(): bool|array
    {
        self::connection();
        $query = self::$pdo->query("SELECT * FROM `" . get_class()::TABLE . "`");
        return $query->fetchAll(PDO::FETCH_CLASS, get_class());
    }

    public static function one(array $model): bool|object
    {
        $keys = [];
        $values = [];
        foreach ($model as $key => $value) {
            $keys[] = $key . " = ?";
            $values[] = $value;
        }
        $keyList = implode(" AND ", $keys);

        self::connection();
        $query = self::$pdo->prepare("SELECT * FROM `" . get_class()::TABLE . "` WHERE " . $keyList);
        $query->execute($values);
        $query->setFetchMode(PDO::FETCH_CLASS, get_class());
        return $query->fetch();
    }

    public function save(): bool
    {
        $keys = [];
        $values = [];
        if (property_exists($this, "id")) {
            foreach ($this as $key => $value) {
                $keys[] = $key . " = ?";
                $values[] = $value;
            }
            $keyList = implode(", ", $keys);

            self::connection();
            $query = self::$pdo->prepare("UPDATE `" . get_class()::TABLE . "` SET " . $keyList . " WHERE id = " . $this->id);
            return $query->execute($values);
        } else {
            $empty = [];
            foreach ($this as $key => $value) {
                $keys[] = $key;
                $empty[] = "?";
                $values[] = $value;
            }
            $keyList = implode(", ", $keys);
            $emptyList = implode(", ", $empty);

            self::connection();
            $query = self::$pdo->prepare("INSERT INTO `" . get_class()::TABLE . "` (" . $keyList . ") VALUES (" . $emptyList . ")");
            return $query->execute($values);
        }
    }

    public static function delete(array $model): bool
    {
        $keys = [];
        $values = [];
        foreach ($model as $key => $value) {
            $keys[] = $key . " = ?";
            $values[] = $value;
        }
        $keyList = implode(" AND ", $keys);

        self::connection();
        $query = self::$pdo->prepare("DELETE FROM `" . get_class()::TABLE . "` WHERE " . $keyList);
        return $query->execute($values);
    }
}
