<?php

namespace Helpers;

class Csv
{
    public static function makeCsvWithUsers(): mixed
    {
        $file = tmpfile();
        foreach ([[100, 'Lion', '' ], [200, 'Tiger'], [300, 'Leopard', '', '']] as $row) {
            fputcsv($file, $row);
        }
        rewind($file);
        return $file;
    }
}
