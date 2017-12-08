<?php

namespace App\Solution;

use App\Model\InputReaderInterface;

class Day08Solution extends AbstractSolution
{
    /**
     * @var int[]
     */
    private $registers = [];

    /**
     * @var callable[]
     */
    private $conditions = [];

    /**
     * @var callable[]
     */
    private $jumps = [];

    public function __construct(InputReaderInterface $inputReader)
    {
        parent::__construct($inputReader);

        $this->jumps = [
            'dec' => function(int $value, int $amount) {
                return $value - $amount;
            },
            'inc' => function(int $value, int $amount) {
                return $value + $amount;
            }
        ];

        $this->conditions = [
            '>' => function(int $left, int $right) {
                return $left > $right;
            },
            '<' => function(int $left, int $right) {
                return $left < $right;
            },
            '>=' => function(int $left, int $right) {
                return $left >= $right;
            },
            '<=' => function(int $left, int $right) {
                return $left <= $right;
            },
            '==' => function(int $left, int $right) {
                return $left == $right;
            },
            '!=' => function(int $left, int $right) {
                return $left != $right;
            },
        ];
    }

    public function part1(): string
    {
        foreach ($this->inputReader->readAll() as $line) {
            list($register, $jump, $amount, $ifRegister, $condition, $value) = $this->parseInstruction($line);

            if ($condition($this->readRegister($ifRegister), $value)) {
                $modifiedValue = $jump($this->readRegister($register), $amount);
                $this->writeRegister($register, $modifiedValue);
            }
        }

        return max($this->registers);
    }

    public function part2(): string
    {
        $largestValue = PHP_INT_MIN;

        foreach ($this->inputReader->readAll() as $line) {
            list($register, $jump, $amount, $ifRegister, $condition, $value) = $this->parseInstruction($line);

            if ($condition($this->readRegister($ifRegister), $value)) {
                $modifiedValue = $jump($this->readRegister($register), $amount);
                $this->writeRegister($register, $modifiedValue);
                $largestValue = max($largestValue, $this->readRegister($register));
            }
        }

        return $largestValue;
    }

    /**
     * Read the value of a register. If the register does not exist, create it and initialize it to 0
     *
     * @param string $name
     * @return int
     */
    private function readRegister(string $name): int
    {
        if (!array_key_exists($name, $this->registers)) {
            $this->registers[$name] = 0;
        }
        return $this->registers[$name];
    }

    /**
     * Write a new value to a register
     *
     * @param string $name
     * @param int $value
     */
    private function writeRegister(string $name, int $value): void
    {
        $this->registers[$name] = $value;
    }

    /**
     * Parse a raw instruction and convert it to usable parts
     *
     * @param $instruction
     * @return array
     */
    private function parseInstruction(string $instruction): array
    {
        $parts = explode(' ', $instruction);

        return [
            $parts[0],
            $this->jumps[$parts[1]],
            (int) $parts[2],
            $parts[4],
            $this->conditions[$parts[5]],
            $parts[6]
        ];
    }
}