<?php

namespace Framework;

use ReflectionObject;

class TestSuite
{
    /**
     * @var array<TestCase>
     */
    private array $cases = [];
    private string $log = '';

    /**
     * @param TestCase $cases
     */
    public function add(...$cases): static
    {
        $this->cases = $cases;

        return $this;
    }

    public function run(): static
    {
        foreach ($this->cases as $case) {
            $ref = new ReflectionObject($case);
            $this->log .= $ref->getName() . "\n";
            $this->log .= $case->run()->log() . "\n";
        }

        return $this;
    }

    public function log(): string
    {
        return $this->log;
    }
}
