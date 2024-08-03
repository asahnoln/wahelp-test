<?php

namespace Unit;

use Framework\Attr\Test;
use Framework\TestCase;
use Helpers\Csv;
use Helpers\Db;
use src\DB\UserRepository;

class UserTest extends TestCase
{
    #[Test]
    public function saves(): void
    {
        $db = new Db();
        $db->createUsers();

        $repo = new UserRepository($db->pdo);
        $repo->saveFromCsvFile(Csv::makeCsvWithUsers());

        $this->assertEqual(
            3,
            $db->pdo->query('SELECT COUNT(*) FROM users')->fetchColumn()
        );

        $res = $repo->all();
        $this->assertEqual(3, count($res));
        $this->assertEqual('Tiger', $res[1]->name);
    }
}
