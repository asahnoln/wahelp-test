<?php

namespace Helpers;

use PDO;

class Db
{
    public PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('sqlite::memory:');
    }

    public function createUsers(): void
    {
        $this->pdo->query('CREATE TABLE users (id INTEGER PRIMARY KEY, name TEXT)');
    }
}
