<?php

use Helpers\Stubs\MailClient;
use src\DB\MailRepository;
use src\DB\SentRepository;
use src\DB\UserRepository;
use src\Services\Console;
use src\Services\MailService;

spl_autoload_register(function ($class) {
    $classPath = str_replace('\\', '/', $class) . '.php';
    $file = __DIR__ . '/' . $classPath;
    if (is_file($file)) {
        require_once $file;
    }
});

$pdo = new PDO();

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
