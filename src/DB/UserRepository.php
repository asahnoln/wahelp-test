<?php

namespace src\DB;

use PDO;

class UserRepository extends BaseRepository
{
    protected string $model = User::class;
    protected string $table = 'users';

    public function saveFromCsvFile(mixed $file): void
    {
        $data = [];
        $sql = "INSERT INTO {$this->table} (id, name) VALUES ";
        while (($row = fgetcsv($file)) !== false) {
            $data[] = $row;
        }
        $sql .= str_repeat('(?, ?),', count($data) - 1) . '(?, ?)';

        $this->pdo->prepare($sql)->execute(array_merge(...$data));
    }
}
