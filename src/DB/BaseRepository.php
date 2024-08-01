<?php

namespace src\DB;

use PDO;

abstract class BaseRepository
{
    public function __construct(protected PDO $pdo)
    {
    }

    abstract public function model(): string;
    abstract public function table(): string;

    /**
     * @return array<stdClass>
     */
    public function all(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table())->fetchAll(PDO::FETCH_CLASS, $this->model());
    }
}
