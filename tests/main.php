<?php

use Framework\TestCaseTest;
use Framework\TestSuiteTest;

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

echo (new TestCaseTest())->run()->log();
