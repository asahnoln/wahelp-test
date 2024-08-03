<?php

namespace src\DB;

use PDO;

abstract class BaseRepository
{
    abstract public static function model(): string;
    abstract public static function table(): string;

    public function __construct(protected PDO $pdo)
    {
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table())->fetchAll(PDO::FETCH_CLASS, $this->model());
    }
}
