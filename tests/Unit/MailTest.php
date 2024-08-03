<?php

namespace Unit;

use Framework\Attr\Test;
use Framework\TestCase;
use Helpers\Csv;
use Helpers\Db;
use Helpers\Stubs\MailClient;
use src\DB\Mailing;
use src\DB\SentRepository;
use src\DB\UserRepository;
use src\Services\MailService;

class MailTest extends TestCase
{
    private Db $db;
    private UserRepository $userRepo;
    private SentRepository $sentRepo;

    public function __construct()
    {
        $this->db = new Db();
        $this->sentRepo = new SentRepository($this->db->pdo);
        $this->userRepo = new UserRepository($this->db->pdo);

    }

    public function beforeEach(): void
    {
        $this->db->createUsers();
        $this->db->createMailings();
        $this->db->createSentMailings();

        $this->userRepo->saveFromCsvFile(Csv::makeCsvWithUsers());
    }

    public function afterEach(): void
    {
        $this->db->drop();
    }

    #[Test]
    public function resendWithoutDupes(): void
    {
        $client = new MailClient();
        $mailService = new MailService($client, $this->sentRepo);

        $mail = new Mailing();
        $mail->id = 234;

        $mailService->sendTo($this->userRepo, $mail);
        $this->assertEqual(3, count($client->sent));

        // All dupes, should not be resent
        $mailService = new MailService($client, $this->sentRepo);
        $mailService->sendTo($this->userRepo, $mail);
        $this->assertEqual(3, count($client->sent));

        // New mailing
        $mail = new Mailing();
        $mail->id = 371;
        $mailService = new MailService($client, $this->sentRepo);
        $mailService->sendTo($this->userRepo, $mail);
        $this->assertEqual(6, count($client->sent));
    }

    #[Test]
    public function doNotSaveWhenClientError(): void
    {
        $client = new MailClient(error: true);
        $mailService = new MailService($client, $this->sentRepo);

        $mail = new Mailing();
        $mail->id = 234;

        $mailService->sendTo($this->userRepo, $mail);
        $this->assertEqual(false, $this->sentRepo->has($mail, $this->userRepo->all()[0]));
    }
}
