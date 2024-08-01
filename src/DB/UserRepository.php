<?php

namespace src\DB;

class UserRepository extends BaseRepository
{
    public function saveFromCsvFile(mixed $file): void
    {
        $data = [];
        $sql = "INSERT INTO {$this->table()} (id, name) VALUES ";
        while (($row = fgetcsv($file)) !== false) {
            $data[] = $row;
        }
        $sql .= str_repeat('(?, ?),', count($data) - 1) . '(?, ?)';

        $this->pdo->prepare($sql)->execute(array_merge(...$data));
    }

    public function model(): string
    {
        return User::class;
    }

    public function table(): string
    {
        return 'users';
    }
}
