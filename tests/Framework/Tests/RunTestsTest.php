<?php

namespace Framework\Tests;

use Framework\Attr\Test;
use Framework\TestCase;

class RunTestsTest extends TestCase
{
    public array $testsDone = [];
    public int $beforeCalls = 0;
    public int $afterCalls = 0;

    public function beforeEach(): void
    {
        $this->beforeCalls++;
    }

    public function afterEach(): void
    {
        $this->afterCalls++;
    }

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
