<?php

namespace Unit;

use Framework\Attr\Test;
use Framework\TestCase;
use Helpers\Db;
use Helpers\Stubs\MailClient;
use src\DB\MailRepository;
use src\DB\SentRepository;
use src\DB\UserRepository;
use src\Services\Console;
use src\Services\MailService;

class ConsoleTest extends TestCase
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

    public function getCsvFileWithUsers(): string
    {
        $filePath = tempnam(sys_get_temp_dir(), 'wah');
        $file = fopen($filePath, 'w');
        foreach ([[10, 'Li'], [20, 'Ti'], [30, 'Le'], [40, 'Du']] as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
        return $filePath;
    }

    #[Test]
    public function createsData(): void
    {
        $ur = new UserRepository($this->db->pdo);

        $c = new Console(
            userRepo: $ur,
            mailRepo: new MailRepository($this->db->pdo),
            sentRepo: new SentRepository($this->db->pdo),
            mailService: new MailService(new MailClient(), new SentRepository($this->db->pdo)),
        );

        $csv = $this->getCsvFileWithUsers();
        $resp = $c->run(['script.php', 'addUsersFrom', $csv]);
        unlink($csv);

        $this->assertEqual(4, count($ur->all()));
        $this->assertEqual('Added users.', $resp);
    }

    #[Test]
    public function sendsMails(): void
    {

        $userRepo = $this->getUserRepo();
        $mailRepo = new MailRepository($this->db->pdo);
        $mailRepo->insert("User Reg");
        $mailRepo->insert("Bonus Prog");

        $sentRepo = new SentRepository($this->db->pdo);

        $mc = new MailClient();
        $ms = new MailService($mc, $sentRepo);
        $c = new Console(
            userRepo: $userRepo,
            mailRepo: $mailRepo,
            sentRepo: $sentRepo,
            mailService: $ms,
        );
        $resp = $c->run(['script.php', 'sendMails']);

        $this->assertEqual(6, count($mc->sent));
        $this->assertEqual('Sent!', $resp);
    }
}
