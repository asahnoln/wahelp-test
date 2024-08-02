<?php

use Helpers\Stubs\MailClient;
use src\DB\MailRepository;
use src\DB\SentRepository;
use src\DB\UserRepository;
use src\Services\Console;
use src\Services\Env;
use src\Services\MailService;

spl_autoload_register(function ($class) {
    $classPath = str_replace('\\', '/', $class) . '.php';
    list($app) = explode('/', $classPath);
    $file = __DIR__ . '/' . ($app != 'src' ? 'tests/' : '') . $classPath;
    if (is_file($file)) {
        require_once $file;
    }
});

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
