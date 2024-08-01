<?php

namespace Unit;

use Framework\Attr\Test;
use Framework\TestCase;
use Helpers\Db;
use Helpers\Stubs\MailClient;
use src\DB\UserRepository;
use src\Services\MailService;

class MailTest extends TestCase
{
    public function getUserRepo(): UserRepository
    {
        $db = new Db();
        $db->createUsers();

        $ut = new UserTest();
        $repo = new UserRepository($db->pdo);
        $repo->saveFromCsvFile($ut->makeCsvWithUsers());
        return $repo;
    }

    #[Test]
    public function sends(): void
    {
        $mc = new MailClient();
        $ms = new MailService($mc);

        $sent = $ms->sendTo($this->getUserRepo());
        $this->assertEqual(true, $sent);
        $this->assertEqual(3, count($mc->sent));
    }

}
