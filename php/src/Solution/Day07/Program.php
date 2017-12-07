<?php

namespace App\Solution\Day07;

class Program
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $weight;

    /**
     * @var array
     */
    private $disc = [];

    /**
     * @var Program|null
     */
    private $supportedBy;

    /**
     * @var int
     */
    private $totalWeight;

    public function __construct(string $name, int $weight)
    {
        $this->name = $name;
        $this->weight = $weight;
    }

    /**
     * Get the program's name
     *
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Get the weight of just this program
     *
     * @return int
     */
    public function weight(): int
    {
        return $this->weight;
    }

    /**
     * Get the weight of this program plus all the programs it supports
     * @return int
     */
    public function totalWeight(): int
    {
        return array_reduce($this->disc, function(int $weight, Program $program) {
            return $weight + $program->totalWeight();
        }, $this->weight());
    }

    /**
     * Get the program's disc aka child programs
     * @return array
     */
    public function disc(): array
    {
        return $this->disc;
    }

    /**
     * Get the supporting program, if it exists
     * @return Program|null
     */
    public function supportedBy(): ?Program
    {
        return $this->supportedBy ?? null;
    }

    /**
     * Add a new program to this program's disc
     *
     * @param Program $program
     */
    public function addToDisc(Program $program): void
    {
        $this->disc[$program->name()] = $program;
        $program->setSupportedBy($this);
    }

    /**
     * Support this program with another
     *
     * @param Program $program
     * @return Program
     */
    public function setSupportedBy(Program $program): Program
    {
        $this->supportedBy = $program;

        return $this;
    }
}
