<?php

namespace App\Solution;

use App\Model\InputReaderInterface;

use \LogicException;

class Day03Solution extends AbstractSolution
{
    private $moves;

    public function __construct(InputReaderInterface $inputReader)
    {
        parent::__construct($inputReader);

        // Callbacks that know how to property manipulate the coordinate
        $this->moves = [
            'right' => function(int &$x, int $y) {
                $x += 1;
            },
            'up' => function(int $x, int &$y) {
                $y += 1;
            },
            'left' => function(int &$x, int $y) {
                $x -= 1;
            },
            'down' => function(int $x, int &$y) {
                $y -= 1;
            },
        ];

        end($this->moves);
    }

    public function part1(): string
    {
        $square = (int) $this->inputReader->readLine();

        if ($square === 1) {
            return 0;
        }

        $x = 0;
        $y = 0;
        $edgeCurrentSize = 0;
        $edgeMaxSize = 1;
        $edgesCreatedAtSize = 0;
        $move = $this->nextMove();

        for ($i = 2; $i <= $square; $i++) {
            $move($x, $y);

            $edgeCurrentSize++;

            // The current edge of the spiral has been filled, so make a turn and start anew
            if ($edgeCurrentSize >= $edgeMaxSize) {
                $move = $this->nextMove();
                $edgesCreatedAtSize++;
                $edgeCurrentSize = 0;
            }

            // Only two edges of a given size need to be created, so reset if the limit has been reached and increase
            // the limit for the next go-round
            if ($edgesCreatedAtSize === 2) {
                $edgesCreatedAtSize = 0;
                $edgeMaxSize++;
            }
        }
        return abs($x) + abs($y);
    }

    public function part2(): string
    {
        $square = (int) $this->inputReader->readLine();

        if ($square === 1) {
            return 1;
        }

        $x = 0;
        $y = 0;
        $edgeCurrentSize = 0;
        $edgeMaxSize = 1;
        $edgesCreatedAtSize = 0;
        $move = $this->nextMove();
        $grid = ['0,0' => 1];

        for ($i = 2; $i <= $square; $i++) {
            $move($x, $y);
            $squareValue = array_sum($this->findNeighbors($x, $y, $grid));

            if ($squareValue > $square) {
                return $squareValue;
            }

            $grid["$x,$y"] = $squareValue;

            $edgeCurrentSize++;

            if ($edgeCurrentSize >= $edgeMaxSize) {
                $move = $this->nextMove();
                $edgesCreatedAtSize++;
                $edgeCurrentSize = 0;
            }

            if ($edgesCreatedAtSize === 2) {
                $edgesCreatedAtSize = 0;
                $edgeMaxSize++;
            }
        }
        throw new LogicException('There is no square value larger than the input');
    }

    /**
     * Find adjacent neighbors to the given point. It is assumed that the given point does not exist in the grid
     *
     * @param int $x
     * @param int $y
     * @param array $grid
     * @return array
     */
    private function findNeighbors(int $x, int $y, array $grid): array
    {
        $neighbors = [];
        for ($i = $x - 1; $i <= $x + 1; $i++) {
            for ($j = $y - 1; $j <= $y + 1; $j++) {
                if (array_key_exists("$i,$j", $grid)) {
                    $neighbors[] = $grid["$i,$j"];
                }
            }
        }
        return $neighbors;
    }

    /**
     * Cyclically loop through the available moves and return the next available
     *
     * @return callable
     */
    private function nextMove(): callable
    {
        next($this->moves);
        if (!current($this->moves)) {
            reset($this->moves);
        }
        return current($this->moves);
    }
}