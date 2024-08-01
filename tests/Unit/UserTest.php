<?php

namespace Unit;

use Framework\Attr\Test;
use Framework\TestCase;
use src\DB\UserRepository;
use PDO;

class UserTest extends TestCase
{
    protected function prepareDb(): PDO
    {
        $pdo = new PDO('sqlite::memory:');
        $pdo->query('CREATE TABLE users (id INTEGER PRIMARY KEY, name TEXT)');
        return $pdo;
    }

    protected function prepareFile(): mixed
    {

        $file = tmpfile();
        foreach ([[100, 'Lion'], [200, 'Tiger'], [300, 'Leopard']] as $row) {
            fputcsv($file, $row);
        }
        rewind($file);
        return $file;
    }

    #[Test]
    public function saves(): void
    {
        $pdo = $this->prepareDb();
        $repo = new UserRepository($pdo);
        $repo->saveFromCsvFile($this->prepareFile());

        $this->assertEqual(
            3,
            $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn()
        );

        $res = $repo->all();
        $this->assertEqual(3, count($res));
        $this->assertEqual('Tiger', $res[1]->name);
    }
}
