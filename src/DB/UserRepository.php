<?php

namespace src\DB;

/**
 * @method array<User> all()
 */
class UserRepository extends BaseRepository
{
    public static function model(): string
    {
        return User::class;
    }

    public static function table(): string
    {
        return 'users';
    }

    public function saveFromCsvFile(mixed $file): void
    {
        $data = [];
        $sql = "INSERT INTO {$this->table()} (id, name) VALUES ";
        while (($row = fgetcsv($file)) !== false) {
            $data[] = array_slice($row, 0, 2);
        }
        $sql .= str_repeat('(?, ?),', count($data) - 1) . '(?, ?)';

        $this->pdo->prepare($sql)->execute(array_merge(...$data));
    }
}
