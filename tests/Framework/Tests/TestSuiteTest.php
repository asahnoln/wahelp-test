<?php

namespace Framework\Tests;

use Framework\Attr\Test;

class TestSuiteTest extends TestCase
{
    #[Test]
    public function runsMultiple()
    {
        $suite = new TestSuite();
        $suite->add(new TestCaseTest(), new RunTestsTest());
        $suite->run();
        $this->assertEqual(2, $suite->casesDone);
    }
}
