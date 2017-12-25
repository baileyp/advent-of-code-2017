<?php

namespace App\Solution;

use App\Solution\Day23\Coprocessor;
use App\Solution\Day23\OptimizedCoprocessor;

class Day23Solution extends AbstractSolution
{
    public function part1(): string
    {
        $registers = array_combine(range('a', 'h'), array_fill(0, 8, 0));
        $coprocessor = new Coprocessor(
            iterator_to_array($this->inputReader->readAll()),
            $registers
        );

        $coprocessor->run();

        return count($coprocessor);
    }
    
    public function part2(): string
    {
        $instructions = array_map(function(string $instruction) {
            return explode(' ', $instruction);
        }, iterator_to_array($this->inputReader->readAll()));

        $bInitial = (int) $instructions[0][2] * 100 + 100000;
        $bMax = $bInitial + abs((int) $instructions[7][2]);
        $bIncrement = abs((int) $instructions[30][2]);

        $h = 0;
        for ($b = $bInitial; $b <= $bMax; $b += $bIncrement) {
            for ($e = 2; $e * $e <= $b; $e++) {
                if ($b % $e == 0) {
                    $h++;
                    break;
                }
            }
        }
        return $h;
    }
}