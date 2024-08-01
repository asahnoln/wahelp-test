<?php

namespace src\DB;

use PDO;

abstract class BaseRepository
{
    protected string $table;

    public function __construct(protected PDO $pdo)
    {
    }

    /**
     * @return array<stdClass>
     */
    public function all(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table)->fetchAll(PDO::FETCH_CLASS, $this->model);
    }
}
