<?php

namespace App\Solution\Day22;

use App\Solution\Day19\Cursor;

class Virus
{
    const RIGHT = 'R';
    const LEFT = 'L';
    const DIRECTIONS = ['N', 'E', 'S', 'W'];

    /**
     * @var Cursor
     */
    protected $location;

    /**
     * @var string
     */
    protected $direction;

    /**
     * @var Grid
     */
    protected $grid;

    /**
     * Virus constructor.
     * @param Cursor $location
     * @param string $direction
     * @param Grid $grid
     */
    public function __construct(Cursor $location, string $direction, Grid $grid)
    {
        $this->location = $location;
        $this->direction = $direction;
        $this->grid = $grid;
    }

    /**
     * Move the virus in its current direction
     */
    public function move(): void
    {
        $this->location = $this->location->move($this->direction);
    }

    /**
     * Infect the current node
     *
     * @return bool
     */
    public function infect(): bool
    {
        $row = $this->location->row();
        $col = $this->location->col();
        $nodeValue = $this->grid->readNode($row, $col);

        if ($nodeValue === Grid::CLEAN) {
            $this->grid->writeNode($row, $col, Grid::INFECTED);
            return true;
        }

        $this->grid->writeNode($row, $col, Grid::CLEAN);
        return false;
    }

    /**
     * Decide which way to turn and then turn
     */
    public function decideAndTurn(): void
    {
        $direction = $this->grid->isInfected($this->location) ? self::RIGHT : self::LEFT;
        $this->turn($direction);
    }

    /**
     * Turn left or right, in-place
     *
     * @param string $direction
     * @return Virus
     */
    protected function turn(string $direction): Virus
    {
        $i = array_search($this->direction, self::DIRECTIONS);
        if ($direction === self::LEFT) {
            $i--;
        }
        if ($direction === self::RIGHT) {
            $i++;
        }
        if ($i < 0) {
            $i = 3;
        }
        elseif($i > 3) {
            $i = 0;
        }

        $this->direction = self::DIRECTIONS[$i];

        return $this;
    }
}