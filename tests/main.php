<?php

require __DIR__ . '/../autoload.php';

use Unit\ConsoleTest;
use Framework\TestSuite;
use Framework\Tests\TestCaseTest;
use Framework\Tests\TestSuiteTest;
use Unit\EnvTest;
use Unit\MailTest;
use Unit\UserTest;

echo (new TestSuite())->add(
    // Project tests
    new UserTest(),
    new MailTest(),
    new ConsoleTest(),
    new EnvTest(),
    // Test framework tests
    new TestCaseTest(),
    new TestSuiteTest(),
)->run()->log();
