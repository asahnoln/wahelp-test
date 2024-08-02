<?php

namespace src\Services;

class Env
{
    public static function parse(string $filePath): void
    {
        $file = fopen($filePath, 'r');
        while ($line = fgets($file)) {
            putenv(trim($line));
        }
    }
}
