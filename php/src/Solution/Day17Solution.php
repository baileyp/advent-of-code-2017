<?php

namespace App\Solution;

use \SplDoublyLinkedList;

class Day17Solution extends AbstractSolution
{
    public function part1(): string
    {
        $steps = (int) $this->inputReader->readLine();
        $memory = new SplDoublyLinkedList();
        $memory->add(0, 0);
        $currentPosition = 0;

        for ($i = 1; $i <= 2017; $i++) {
            $currentPosition = (($currentPosition + $steps) % $i) + 1;
            $memory->add($currentPosition, $i);
        }

        return $memory[$currentPosition + 1];
    }
    
    public function part2(): string
    {
        $steps = (int) $this->inputReader->readLine();

        $valueAfterZero = null;
        $currentPosition = 0;
        for ($i = 1; $i <= 5e7; $i++) {
            $currentPosition = (($currentPosition + $steps) % $i) + 1;
            if ($currentPosition === 1) {
                $valueAfterZero = $i;
            }
        }
        return $valueAfterZero;
    }
}