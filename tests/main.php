<?php

use Framework\TestSuite;
use Framework\Tests\TestCaseTest;
use Framework\Tests\TestSuiteTest;
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

echo (new TestSuite())->add(
    // Project tests
    new UserTest(),
    // Test framework tests
    new TestCaseTest(),
    new MailTest(),
    new TestSuiteTest(),
)->run()->log();
