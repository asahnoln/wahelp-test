<?php

namespace src\DB;

class MailRepository extends BaseRepository
{
    public static function model(): string
    {
        return Mailing::class;
    }

    public static function table(): string
    {
        return 'mailings';
    }

    public function insert(string $name): bool
    {
        $q = $this->pdo->prepare("INSERT INTO {$this->table()} (name) VALUES (?)");
        return $q->execute([$name]);
    }
}
