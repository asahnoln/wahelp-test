<?php

namespace src\DB;

class UserRepository
{
    protected array $data = [];

    public function saveFromCsvFile($file): void
    {
        while (($row = fgetcsv($file)) !== false) {
            $this->data[] = new User($row[0], $row[1]);
        }
    }

    public function all(): array
    {
        return $this->data;
    }
}
