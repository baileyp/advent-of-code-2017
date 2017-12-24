<?php

namespace App\Solution\Day22;

use App\Solution\Day19\Cursor;

class Grid
{
    const CLEAN = '.';
    const INFECTED = '#';
    const WEAKENED = 'W';
    const FLAGGED = 'F';

    /**
     * @var array
     */
    private $grid;

    /**
     * Grid constructor.
     * @param array $grid
     */
    public function __construct(array &$grid)
    {
        $this->grid = $grid;
    }

    /**
     * Create a cursor that is located at the middle of the grid
     *
     * @return Cursor
     */
    public function middle(): Cursor
    {
        $width = count($this->grid);
        $height = count(current($this->grid));
        return new Cursor(($height - 1) / 2, ($width - 1) / 2);
    }

    /**
     * Read the value of the node at <$col, $row>
     *
     * @param int $row
     * @param int $col
     * @return string
     */
    public function readNode(int $row, int $col): string
    {
        $this->initNode($row, $col);
        return $this->grid[$row][$col];
    }

    /**
     * Write a new value to the node at <$col, $row>
     *
     * @param int $row
     * @param int $col
     * @param string $value
     * @return Grid
     */
    public function writeNode(int $row, int $col, string $value): Grid
    {
        $this->initNode($row, $col);
        $this->grid[$row][$col] = $value;

        return $this;
    }

    /**
     * Is the node at $cursor infected?
     *
     * @param Cursor $cursor
     * @return bool
     */
    public function isInfected(Cursor $cursor): bool
    {
        return $this->readNode($cursor->row(), $cursor->col()) === self::INFECTED;
    }

    /**
     * Initialize a node at <$col, $row>, which might not yet exist in the grid. If the coordinate doesn't exist,
     * create it and set to the "clean" state
     *
     * @param int $row
     * @param int $col
     */
    private function initNode(int $row, int $col): void
    {
        if (!array_key_exists($row, $this->grid)) {
            $this->grid[$row] = [];
        }
        if (!array_key_exists($col, $this->grid[$row])) {
            $this->grid[$row][$col] = self::CLEAN;
        }
    }

    /**
     * Print the current state of the nodes
     */
    public function print()
    {
        $width = max(array_map('count', $this->grid));
        $height = count($this->grid);

        $startingRow = min(array_keys($this->grid));
        $startingCol = min(array_map(function(array $row) {
             return min(array_keys($row));
        }, $this->grid));

        echo PHP_EOL;

        for ($row = $startingRow; $row < $startingRow + $height; $row++) {
            for ($col = $startingCol; $col < $startingCol + $width; $col++) {
                echo $this->readNode($row, $col), ' ';
            }
            echo PHP_EOL;
        }
    }
}