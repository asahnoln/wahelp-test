<?php

namespace src\DB;

use PDO;

class UserRepository
{
    protected array $data = [];

    public function __construct(protected PDO $pdo)
    {
    }

    public function saveFromCsvFile(mixed $file): void
    {
        $data = [];
        $sql = 'INSERT INTO users (id, name) VALUES ';
        while (($row = fgetcsv($file)) !== false) {
            $data[] = $row;
        }
        $sql .= str_repeat('(?, ?),', count($data) - 1) . '(?, ?)';

        $this->pdo->prepare($sql)->execute(array_merge(...$data));
    }

    /**
     * @return array<User>
     */
    public function all(): array
    {
        return $this->pdo->query('SELECT * FROM users')->fetchAll(PDO::FETCH_CLASS, User::class);
    }
}
