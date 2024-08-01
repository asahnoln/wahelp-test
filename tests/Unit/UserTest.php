<?php

namespace Unit;

use Framework\Attr\Test;
use Framework\TestCase;
use src\DB\User;
use src\DB\UserRepository;

class UserTest extends TestCase
{
    protected function prepareFile(): mixed
    {

        $file = tmpfile();
        foreach ([[100, 'Lion'], [200, 'Tiger'], [300, 'Leopard']] as $row) {
            fputcsv($file, $row);
        }
        rewind($file);
        return $file;
    }

    #[Test]
    public function saves(): void
    {
        $repo = new UserRepository();
        $repo->saveFromCsvFile($this->prepareFile());

        $res = $repo->all();
        $this->assertEqual(3, count($res));
        $this->assertEqual('Tiger', $res[1]->name);
    }
}
