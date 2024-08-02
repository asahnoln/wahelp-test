<?php

namespace Unit;

use Framework\Attr\Test;
use Framework\TestCase;
use src\Services\Env;

class EnvTest extends TestCase
{
    #[Test]
    public function getsAllEnvs(): void
    {
        $filePath = tempnam(sys_get_temp_dir(), 'wahenv');
        $file = fopen($filePath, 'w');
        fwrite($file, "TESTENV=HERE\nDEV=true");
        fclose($file);

        Env::parse($filePath);

        $this->assertEqual('HERE', getenv('TESTENV'));
        $this->assertEqual('true', getenv('DEV'));

        unlink($filePath);
    }
}
