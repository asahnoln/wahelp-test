<?php

require_once __DIR__ . '/autoload.php';

use Helpers\Stubs\MailClient;
use src\DB\MailRepository;
use src\DB\SentRepository;
use src\DB\UserRepository;
use src\Services\Console;
use src\Services\Env;
use src\Services\MailService;

Env::parse(__DIR__ . '/.env');

$pdo = new PDO(getenv('DSN'));

$userRepo = new UserRepository($pdo);
$mailRepo = new MailRepository($pdo);
$sentRepo = new SentRepository($pdo);

$c = new Console(
    userRepo: $userRepo,
    mailRepo: $mailRepo,
    sentRepo: $sentRepo,
    mailService: new MailService(new MailClient(), $sentRepo),
);
echo $c->run($argv);
