<?php

spl_autoload_register(function ($class) {
    $classPath = str_replace('\\', '/', $class) . '.php';
    list($app) = explode('/', $classPath);
    $file = __DIR__ . '/' . ($app != 'src' ? 'tests/' : '') . $classPath;
    if (is_file($file)) {
        require_once $file;
    }
});
