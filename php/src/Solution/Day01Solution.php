<?php

namespace App\Solution;

class Day01Solution extends AbstractSolution
{
    public function part1(): string
    {
        $input = $this->inputReader->readLine();
        $sum = 0;

        for ($i = 0, $next = 1, $l = strlen($input); $i < $l; $i++, $next++) {
            if ($next === $l) {
                $next = 0;
            }

            if ($input{$i} === $input{$next}) {
                $sum += (int) $input{$i};
            }
        }

        return $sum;
    }

    public function part2(): string
    {
        $input = $this->inputReader->readLine();
        $sum = 0;

        for ($i = 0, $l = strlen($input), $next = $l / 2; $i < $l; $i++, $next++) {
            if ($next === $l) {
                $next = 0;
            }

            if ($input{$i} === $input{$next}) {
                $sum += (int) $input{$i};
            }
        }

        return $sum;
    }
}