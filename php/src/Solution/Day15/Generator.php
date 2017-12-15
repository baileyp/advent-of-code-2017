<?php

namespace App\Solution\Day15;

class Generator
{
    const DIVISOR = 2147483647;

    /**
     * @var int
     */
    private $factor;

    /**
     * @var int
     */
    protected $previousValue;

    /**
     * Generator constructor.
     * @param int $initialValue
     * @param int $factor
     */
    public function __construct(int $initialValue, int $factor)
    {
        $this->previousValue = $initialValue;
        $this->factor = $factor;
    }

    /**
     * Generate and return the next value
     *
     * @return int
     */
    public function nextValue(): int
    {
        return $this->previousValue = ($this->previousValue * $this->factor) % self::DIVISOR;
    }
}