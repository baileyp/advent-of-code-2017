<?php

namespace App\Solution;

class Day11Solution extends AbstractSolution
{
    public function part1(): string
    {
        $steps = explode(',', $this->inputReader->readLine());
        $x = $y = 0;

        foreach ($steps as $step) {
            $this->applyStep($step, $x, $y);
        }

        return $this->distanceFromCenter($x, $y);
    }
    
    public function part2(): string
    {
        $steps = explode(',', $this->inputReader->readLine());
        $x = $y = $maxDistance = 0;

        foreach ($steps as $step) {
            $this->applyStep($step, $x, $y);
            $maxDistance = max($maxDistance, $this->distanceFromCenter($x, $y));
        }

        return $maxDistance;
    }

    /**
     * Apply a step to a coordinate pair. Mutates values.
     *
     * @param string $step
     * @param int $x
     * @param float $y
     */
    private function applyStep(string $step, int &$x, float &$y): void
    {
        switch ($step) {
            case 'n':
                $y--;
                break;
            case 's':
                $y++;
                break;
            case 'ne':
                $x++;
                $y = $y - .5;
                break;
            case 'nw':
                $x--;
                $y -= .5;
                break;
            case 'se':
                $x++;
                $y += .5;
                break;
            case 'sw':
                $x--;
                $y += .5;
                break;
        }
    }

    /**
     * Calculate the distance that ($x, $y) is away from (0, 0)
     *
     * @param int $x
     * @param float $y
     * @return int
     */
    private function distanceFromCenter(int $x, float $y): int
    {
        $x = abs($x);
        $y = max(0, abs($y) - ($x / 2));

        return $x + $y;
    }
}