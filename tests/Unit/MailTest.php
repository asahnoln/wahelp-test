<?php

namespace Unit;

use Framework\Attr\Test;
use Framework\TestCase;
use Helpers\Db;
use Helpers\Stubs\MailClient;
use src\DB\Mailing;
use src\DB\MailingRepository;
use src\DB\SentRepository;
use src\DB\UserRepository;
use src\Services\MailService;

class MailTest extends TestCase
{
    private Db $db;
    public function __construct()
    {
        $this->db = new Db();
    }

    public function beforeEach(): void
    {
        $this->db->createUsers();
        $this->db->createMailings();
        $this->db->createSentMailings();
    }

    public function afterEach(): void
    {
        $this->db->drop();
    }

    public function getUserRepo(): UserRepository
    {
        $ut = new UserTest();
        $repo = new UserRepository($this->db->pdo);
        $repo->saveFromCsvFile($ut->makeCsvWithUsers());
        return $repo;
    }

    #[Test]
    public function resendWithoutDupes(): void
    {
        $sentRepo = new SentRepository($this->db->pdo);
        $userRepo = $this->getUserRepo();

        $client = new MailClient();
        $mailService = new MailService($client, $sentRepo);

        $mail = new Mailing();
        $mail->id = 234;

        $mailService->sendTo($userRepo, $mail);

        $mailService = new MailService($client, $sentRepo);
        $mailService->sendTo($userRepo, $mail);
        $this->assertEqual(3, count($client->sent));
    }
}
