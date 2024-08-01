<?php

namespace Framework;

use ReflectionClass;
use Framework\Attr\Test;

abstract class TestCase
{
    protected array $log = [];

    public function run(): static
    {
        $reflection = new ReflectionClass($this);
        foreach ($reflection->getMethods() as $method) {
            $attrs = $method->getAttributes(Test::class);
            if (count($attrs)) {
                $this->beforeEach();
                try {
                    $this->{$method->getName()}();
                    $this->log[$method->getName()] = 'DONE';
                } catch (\Exception $e) {
                    $this->log[$method->getName()] = "\033[31mFAIL:\033[0m " . $e->getMessage();
                }
                $this->afterEach();
            }
        }

        return $this;
    }

    public function assertEqual(mixed $want, mixed $got): void
    {
        if ($want != $got) {
            throw new \Exception("Expected '{$got}' to be equal to '{$want}'");
        }
    }

    public function log(): string
    {
        $result = '';
        foreach ($this->log as $method => $state) {
            $result .= "{$method}\t{$state}\n";
        }

        return $result;
    }

    public function beforeEach(): void
    {

    }

    public function afterEach(): void
    {

    }
}
