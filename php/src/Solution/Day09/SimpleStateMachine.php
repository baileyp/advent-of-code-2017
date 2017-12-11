<?php

namespace App\Solution\Day09;

use \ArrayAccess;
use \Closure;
use \LogicException;
use \OutOfBoundsException;

class SimpleStateMachine implements ArrayAccess
{
    private $state;
    private $operations;
    private $default;

    /**
     * SimpleStateMachine constructor.
     * @param array $state
     * @param array $operations
     * @param callable $default
     */
    public function __construct(array $state, array $operations, callable $default)
    {
        $this->state = $state;
        $this->operations = $operations;
        $this->default = $default;
    }

    /**
     * Apply the operations to a string of characters
     *
     * @param string $input
     */
    public function run(string $input): void
    {
        for ($i = 0, $l = strlen($input); $i < $l; $i++) {
            if (array_key_exists($input{$i}, $this->operations)) {
                $this->operations[$input{$i}]($this, $i);
            } else {
                Closure::fromCallable($this->default)($this, $i);
            }
        }
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->state);
    }

    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            throw new OutOfBoundsException("State '$offset' does not exist.");
        }
        return $this->state[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if (!$this->offsetExists($offset)) {
            throw new OutOfBoundsException("State '$offset' does not exist.");
        }
        $this->state[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        throw new LogicException("Cannot unset established state.");
    }
}