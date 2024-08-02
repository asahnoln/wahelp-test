<?php

namespace Unit;

use Framework\Attr\Test;
use Framework\TestCase;
use Helpers\Db;
use src\DB\UserRepository;
use PDO;

class UserTest extends TestCase
{
    public function makeCsvWithUsers(): mixed
    {
        $file = tmpfile();
        foreach ([[100, 'Lion', '' ], [200, 'Tiger'], [300, 'Leopard', '', '']] as $row) {
            fputcsv($file, $row);
        }
        rewind($file);
        return $file;
    }

    #[Test]
    public function saves(): void
    {
        $db = new Db();
        $db->createUsers();

        $repo = new UserRepository($db->pdo);
        $repo->saveFromCsvFile($this->makeCsvWithUsers());

        $this->assertEqual(
            3,
            $db->pdo->query('SELECT COUNT(*) FROM users')->fetchColumn()
        );

        $res = $repo->all();
        $this->assertEqual(3, count($res));
        $this->assertEqual('Tiger', $res[1]->name);
    }
}
