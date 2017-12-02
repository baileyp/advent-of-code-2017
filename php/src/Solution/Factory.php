<?php

namespace App\Solution;

use App\Model\FileInputReader;
use App\Model\StdinReader;
use \RuntimeException;

/**
 * Factory for creating puzzle solutions from primitive input
 */
class Factory
{
    private $solutionNamespace;

    public function __construct(string $solutionNamespace = __NAMESPACE__)
    {
        $this->solutionNamespace = $solutionNamespace;
    }

    /**
     * Create a Puzzle Solution and return a callable that will invoke the correct part
     *
     * @param int $day
     * @param int $part
     * @return callable
     *
     * @codeCoverageIgnore
     */
    public function createCallable(int $day, int $part): callable
    {
        $solutionClass = sprintf("%s\Day%'02dSolution", $this->solutionNamespace, $day);
        $method = $part === 1 ? "part1" : "part2";

        if (!class_exists($solutionClass)) {
            throw new RuntimeException("Solution for the specified day does not yet exist.");
        }

        return function(string $input = null) use ($solutionClass, $method, $day) {
            if (!$input) {
                $input = sprintf("../common/day-%'02d/input.txt", $day);
            }

            $reader = is_file($input) ? new FileInputReader($input) : new StdinReader($input);
            return (new $solutionClass($reader))->$method();
        };
    }
}