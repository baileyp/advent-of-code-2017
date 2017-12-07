<?php

namespace App\Solution\Day07;

use \LogicException;

class Tower
{
    /**
     * @var Program[]
     */
    private $programs;

    /**
     * Retrieve a program by its name
     *
     * @param string $programName
     * @return Program
     */
    public function findProgram(string $programName): Program
    {
        return $this->programs[$programName];
    }

    /**
     * Add a program to the tower
     *
     * @param Program $program
     */
    public function addProgram(Program $program): void
    {
        $this->programs[$program->name()] = $program;
    }

    /**
     * Write one or more programs to the disc of another
     *
     * @param string $programName
     * @param string[] ...$children
     */
    public function writeProgramsToDisc(string $programName, string ...$children): void
    {
        $program = $this->findProgram($programName);
        foreach ($children as $child) {
            $program->addToDisc($this->findProgram($child));
        }
    }

    /**
     * Find the base program of the tower
     *
     * @return Program
     *
     * @throws \LogicException
     */
    public function base(): Program
    {
        foreach ($this->programs as $programName => $program) {
            if (!$program->supportedBy()) {
                return $program;
            }
        }

        throw new LogicException('Tower is expected to have a base');
    }

    /**
     * Find the amount of imbalance in the tower.
     *
     * @return int
     *
     * @codeCoverageIgnore
     */
    public function findImbalance(): int
    {
        return $this->findImbalanceRecursive($this->base());
    }

    /**
     * Recursively search for the imbalanced program and return the amount of imbalance
     *
     * @param Program $program
     * @return int
     *
     * @codeCoverageIgnore
     */
    private function findImbalanceRecursive(Program $program): int
    {
        $weights = [];

        // Build up a hashtable of weight => programs
        foreach ($program->disc() as $supported) {
            $weights[$supported->totalWeight()][] = $supported->name();
        }

        if (count($weights) === 1) {
            throw new LogicException('Program is balanced!');
        }

        // Identify the balanced and imbalanced weights
        foreach ($weights as $weight => $programsAtWeight) {
            if (count($programsAtWeight) === 1) {
                $imbalancedWeight = $weight;
            } else {
                $balancedWeight = $weight;
            }
        }

        $imbalancedProgram = $this->programs[$weights[$imbalancedWeight][0]];

        // Basically - is the imbalance, here or in a program on the disc?
        try {
            return $this->findImbalanceRecursive($imbalancedProgram);
        }
        catch (LogicException $e) {
            $imbalance = abs($balancedWeight - $imbalancedWeight);
            return abs($imbalancedProgram->weight() - $imbalance);
        }
    }
}
