<?php

namespace App\Solution;

use App\Model\InputReaderInterface;

/**
 * Common solution that composes an input reader
 */
abstract class AbstractSolution implements SolutionInterface
{
    protected $inputReader;

    /**
     * AbstractSolution constructor.
     *
     * @param InputReaderInterface $inputReader
     */
    public function __construct(InputReaderInterface $inputReader)
    {
        $this->inputReader = $inputReader;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function part1(): string
    {
        return "Not Implemented";
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function part2(): string
    {
        return "Not Implemented";
    }
}