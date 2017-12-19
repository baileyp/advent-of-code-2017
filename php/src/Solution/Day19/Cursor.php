<?php

namespace App\Solution\Day19;

use \UnexpectedValueException;

class Cursor
{
    /**
     * Cursor constructor.
     * @param int $row
     * @param int $col
     */
    public function __construct(int $row, int $col)
    {
        $this->row = $row;
        $this->col = $col;
    }

    /**
     * Row value of this cursor
     *
     * @return int
     */
    public function row(): int
    {
        return $this->row;
    }

    /**
     * Column value of this cursor
     *
     * @return int
     */
    public function col(): int
    {
        return $this->col;
    }

    /**
     * Create a new Cursor that represents a move in the given $direction
     *
     * @param string $direction
     * @return Cursor
     * @throws \UnexpectedValueException
     */
    public function move(string $direction): Cursor
    {
        switch ($direction) {
            case 'N':
                return new self($this->row - 1, $this->col);
            case 'S':
                return new self($this->row + 1, $this->col);
            case 'E':
                return new self($this->row , $this->col + 1);
            case 'W':
                return new self($this->row, $this->col - 1);
        }
        throw new UnexpectedValueException("Unrecognized direction: $direction");
    }
}