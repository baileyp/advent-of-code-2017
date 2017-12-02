<?php

namespace App\Solution;

/**
 * Interface for puzzle solutions
 */
interface SolutionInterface
{
    /**
     * Solve the problem in part 1
     *
     * @return string
     */
    public function part1() : string;

    /**
     * Solve the problem in part 2
     *
     * @return string
     */
    public function part2() : string;
}