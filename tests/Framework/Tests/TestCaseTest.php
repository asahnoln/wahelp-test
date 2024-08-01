<?php

namespace Framework\Tests;

use Framework\Attr\Test;
use Framework\TestCase;

class TestCaseTest extends TestCase
{
    #[Test]
    public function runs(): void
    {
        $test = new RunTestsTest();
        $this->assertEqual(count($test->testsDone), 0);

        $test->run();
        $this->assertEqual(count($test->testsDone), 2);
    }

    #[Test]
    public function assertSucceeds(): void
    {
        $this->assertEqual(1, 1);
    }

    #[Test]
    public function assertFails(): void
    {
        try {
            $this->assertEqual(1, 2);
        } catch (\Exception $e) {
            $this->assertEqual($e->getMessage(), "Expected '1' to be equal to '2'");
        }
    }

    #[Test]
    public function logs(): void
    {
        $test = new LogTest();
        $test->run();
        $this->assertEqual("success\tDONE\nfail\t\033[31mFAIL:\033[0m Expected '5' to be equal to '6'\n", $test->log());
    }
}
