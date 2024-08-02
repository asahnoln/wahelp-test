<?php

namespace Framework\Tests;

use Framework\Attr\Test;
use Framework\TestCase;
use Framework\TestSuite;

class TestSuiteTest extends TestCase
{
    #[Test]
    public function logs()
    {
        $suite = new TestSuite();
        $t1 = new RunTestsTest();
        $t2 = new LogTest();
        $suite->add($t1, $t2)->run();

        $this->assertEqual(true, strpos($suite->log(), 'RunTestsTest') !== false);
        $this->assertEqual(true, strpos($suite->log(), 'LogTest') !== false);
    }
}
