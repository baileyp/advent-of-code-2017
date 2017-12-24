<?php

namespace App\Solution\Day22;

class EvolvedVirus extends Virus
{
    private const INFECTION_MAP = [
        Grid::CLEAN => Grid::WEAKENED,
        Grid::WEAKENED => Grid::INFECTED,
        Grid::INFECTED => Grid::FLAGGED,
        Grid::FLAGGED => Grid::CLEAN,
    ];

    /**
     * {@inheritdoc}
     * @return bool
     */
    public function infect(): bool
    {
        $row = $this->location->row();
        $col = $this->location->col();
        $nodeValue = $this->grid->readNode($row, $col);

        $this->grid->writeNode($row, $col, self::INFECTION_MAP[$nodeValue]);

        return $this->grid->isInfected($this->location);
    }

    /**
     * {@inheritdoc}
     */
    public function decideAndTurn(): void
    {
        switch ($this->grid->readNode($this->location->row(), $this->location->col())) {
            case Grid::CLEAN:
                $this->turn(self::LEFT);
                break;
            case Grid::INFECTED:
                $this->turn(self::RIGHT);
                break;
            case Grid::FLAGGED:
                $this->turn(self::LEFT)->turn(self::LEFT);
                break;
        }
    }
}