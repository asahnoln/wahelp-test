<?php

namespace Framework;

use Framework\Attr\Test;

class LogTest extends TestCase
{
    #[Test]
    public function success()
    {
        $this->assertEqual(5, 5);
    }

    #[Test]
    public function fail()
    {
        $this->assertEqual(5, 6);
    }
}
