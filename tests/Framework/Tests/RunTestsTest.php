<?php

namespace Framework\Tests;

use Framework\Attr\Test;
use Framework\TestCase;

class RunTestsTest extends TestCase
{
    public array $testsDone = [];

    #[Test]
    public function smth(): void
    {
        $this->testsDone['smth'] = true;
    }

    #[Test]
    public function else(): void
    {
        $this->testsDone['else'] = true;
    }

}
