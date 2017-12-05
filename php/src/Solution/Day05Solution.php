<?php

namespace App\Solution;

class Day05Solution extends AbstractSolution
{
    public function part1(): string
    {
        $offsets = array_map('intval', iterator_to_array($this->inputReader->readAll()));
        $upper = count($offsets);

        $cursor = 0;
        $jumps = 0;

        while ($cursor >= 0 && $cursor < $upper) {
            $cursor += $offsets[$cursor]++;
            $jumps++;
        }

        return (string) $jumps;
    }

    public function part2(): string
    {
        $offsets = array_map('intval', iterator_to_array($this->inputReader->readAll()));
        $upper = count($offsets);

        $cursor = 0;
        $jumps = 0;

        while ($cursor >= 0 && $cursor < $upper) {
            if ($offsets[$cursor] >= 3) {
                $cursor += $offsets[$cursor]--;
            } else {
                $cursor += $offsets[$cursor]++;
            }
            $jumps++;
        }

        return (string) $jumps;
    }
}