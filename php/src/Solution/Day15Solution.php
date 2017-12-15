<?php

namespace App\Solution;

use App\Solution\Day15\{CriteriaGenerator, Generator};

class Day15Solution extends AbstractSolution
{
    const FACTOR_A = 16807;
    const FACTOR_B = 48271;
    const ITERATIONS_1 = 4e7;
    const ITERATIONS_2 = 5e6;
    const BIT_MASK = (2 ** 16) - 1;

    public function part1(): string
    {
        $generatorA = new Generator($this->parseInitialValue($this->inputReader->readLine()), self::FACTOR_A);
        $generatorB = new Generator($this->parseInitialValue($this->inputReader->readLine()), self::FACTOR_B);

        $matches = 0;

        for ($i = 0; $i < static::ITERATIONS_1; $i++) {
            if (($generatorA->nextValue() & self::BIT_MASK) === ($generatorB->nextValue() & self::BIT_MASK)) {
                $matches++;
            }
        }

        return $matches;
    }
    
    public function part2(): string
    {
        $generatorA = new CriteriaGenerator($this->parseInitialValue($this->inputReader->readLine()), self::FACTOR_A);
        $generatorB = new CriteriaGenerator($this->parseInitialValue($this->inputReader->readLine()), self::FACTOR_B);

        $generatorA->setCriteria(function(int $value): bool {
            return $value % 4 === 0;
        });

        $generatorB->setCriteria(function(int $value): bool {
            return $value % 8 === 0;
        });

        $matches = 0;

        for ($i = 0; $i < static::ITERATIONS_2; $i++) {
            if (($generatorA->nextValue() & self::BIT_MASK) === ($generatorB->nextValue() & self::BIT_MASK)) {
                $matches++;
            }
        }

        return $matches;
    }

    /**
     * Parse the initial generator value from an input line and return it
     *
     * @param string $line
     * @return int
     */
    private function parseInitialValue(string $line): int
    {
        if (preg_match("/^Generator [AB] starts with ([\d]+)/", $line, $matches)) {
            return (int) $matches[1];
        }
        throw new \LogicException("Bad line");
    }
}