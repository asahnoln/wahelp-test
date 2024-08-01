<?php

use Framework\Tests\TestCaseTest;
use Unit\MailTest;
use Unit\UserTest;

spl_autoload_register(function ($class) {
    $classPath = str_replace('\\', '/', $class) . '.php';
    list($app) = explode('/', $classPath);
    $file = __DIR__ . '/' . ($app == 'src' ? '../' : '') . $classPath;
    if (is_file($file)) {
        require_once $file;
    }
});

echo (new TestCaseTest())->run()->log();
echo (new UserTest())->run()->log();
echo (new MailTest())->run()->log();
