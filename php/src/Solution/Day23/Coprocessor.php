<?php

namespace App\Solution\Day23;

use \Countable;

class Coprocessor implements Countable
{
    /**
     * @var array
     */
    protected $instructions = [];

    /**
     * @var int
     */
    protected $cursor = 0;

    /**
     * @var array
     */
    protected $registers;

    /**
     * @var int
     */
    protected $mulInvokes = 0;

    /**
     * Coprocessor constructor.
     * @param array $instructions
     * @param array $registers
     */
    public function __construct(array $instructions, array $registers)
    {
        $this->registers = $registers;

        // Convert raw instructions into simple callables
        $this->instructions = array_map(function (string $instruction) {
            $parts = explode(' ', $instruction);
            return function() use ($parts) {
                $func = array_shift($parts);
                call_user_func([$this, $func], ...$parts);
            };
        }, $instructions);
    }

    /**
     * Run the instructions
     */
    public function run(): void
    {
        while (array_key_exists($this->cursor, $this->instructions)) {
            call_user_func($this->instructions[$this->cursor]);
        }
    }

    /**
     * Set register $x to $y
     *
     * @param string $x
     * @param string $y
     */
    public function set(string $x, string $y): void
    {
        $this->registers[$x] = $this->normalize($y);
        $this->cursor++;
    }

    /**
     * Subtract the value in register $x by $y
     *
     * @param string $x
     * @param string $y
     */
    public function sub(string $x, string $y): void
    {
        $this->registers[$x] -= $this->normalize($y);
        $this->cursor++;
    }

    /**
     * Multiple the value in register $x by $y
     *
     * @param string $x
     * @param string $y
     */
    public function mul(string $x, string $y): void
    {
        $this->mulInvokes++;
        $this->registers[$x] *= $this->normalize($y);
        $this->cursor++;
    }

    /**
     * Jump by $y if the value in register $x is not zero
     * @param string $x
     * @param string $y
     */
    public function jnz(string $x, string $y): void
    {
        if ($this->normalize($x) !== 0) {
            $this->cursor += $this->normalize($y);
        } else {
            $this->cursor++;
        }
    }

    /**
     * Return the number of times mul() was invoked
     * @return int
     */
    public function count(): int
    {
        return $this->mulInvokes;
    }

    /**
     * Normalize an input value by either casting a numeric as an int, or reading a register's value
     *
     * @param string $value
     * @return int
     */
    protected function normalize(string $value): int
    {
        if (is_numeric($value)) {
            return (int) $value;
        }
        return $this->registers[$value];
    }
}