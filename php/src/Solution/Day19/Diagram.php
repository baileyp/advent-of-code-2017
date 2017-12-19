<?php

namespace App\Solution\Day19;

use \LogicException;

class Diagram
{
    /**
     * @var array
     */
    private $grid;

    /**
     * @var mixed
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var array
     */
    private $collection = [];

    /**
     * @var array
     */
    private $collectible = [];

    /**
     * Diagram constructor.
     * @param array $grid
     * @param array $collectible
     */
    public function __construct(array $grid, array $collectible)
    {
        $this->grid = $grid;
        $this->width = max(array_map('count', $grid));
        $this->height = count($grid);
        $this->collectible = array_flip($collectible);
    }

    /**
     * Yield the letters collected along the path
     *
     * @return array
     */
    public function collection(): array
    {
        return array_keys($this->collection);
    }

    /**
     * Is the given $char collectible
     *
     * @param string $char
     * @return bool
     */
    public function isCollectible(string $char): bool
    {
        return array_key_exists($char, $this->collectible);
    }

    /**
     * Follow the diagram path starting at $cursor heading in $direction and return the number of steps taken along
     * the path
     *
     * @param Cursor $cursor
     * @param string $direction
     * @return int
     */
    public function followPath(Cursor $cursor, string $direction): int
    {
        $stepsTaken = 0;
        while (true) {
            $cursor = $cursor->move($direction);

            if (!$this->inBounds($cursor)) {
                break;
            }
            $stepsTaken++;
            
            $char = $this->charAtCursor($cursor);
            if ($this->isCollectible($char)) {
                $this->collection[$char] = true;
            }
            elseif ($char === '+') {
                $direction = $this->turn($cursor, $direction);
                if (!$direction) {
                    break;
                }
            }
            elseif ($char === ' ') {
                break;
            }
        }
        return $stepsTaken;
    }

    /**
     * Given a current position and direction, yield a valid new direction if one exists
     *
     * @param Cursor $cursor
     * @param string $direction
     * @return null|string
     */
    public function turn(Cursor $cursor, string $direction): ?string
    {
        // Pre-fetch all the cardinal moves
        $choices = [
            'N' => $cursor->move('N'),
            'S' => $cursor->move('S'),
            'E' => $cursor->move('E'),
            'W' => $cursor->move('W'),
        ];

        // Remove the choice where we just came from
        unset($choices[$this->from($direction)]);

        // Remove choices that are out of bounds
        $choices = array_filter($choices, [$this, 'inBounds']);

        // Convert choices to grid characters
        $choices = array_map([$this, 'charAtCursor'], $choices);

        // Remove choices that are blank or are noise given the current direction
        $choices = array_filter($choices, function(string $char, string $direction) {
            if ($char === '|' && ($direction === 'E' || $direction == 'W')) {
                return false;
            }
            if ($char === '-' && ($direction === 'N' || $direction == 'S')) {
                return false;
            }
            if ($char === ' ') {
                return false;
            }
            return true;
        }, ARRAY_FILTER_USE_BOTH);

        if (count($choices) === 1) {
            return key($choices);
        }
        if (count($choices) === 0) {
            return null;
        }

        throw new LogicException('Multiple turn choices are not accomodated');
    }

    /**
     * Given a directon, return the cardinal opposite
     *
     * @param string $direction
     * @return string
     */
    private function from(string $direction): string
    {
        return [
            'S' => 'N',
            'N' => 'S',
            'E' => 'W',
            'W' => 'E',
        ][$direction];
    }

    /**
     * Read the character at $cursor position in the Diagram
     *
     * @param Cursor $cursor
     * @return string
     */
    private function charAtCursor(Cursor $cursor): string
    {
        return $this->grid[$cursor->row()][$cursor->col()];
    }

    /**
     * Is the given cursor within the boundary of this Diagram?
     *
     * @param Cursor $cursor
     * @return bool
     */
    private function inBounds(Cursor $cursor): bool
    {
        return ($cursor->row() >= 0 && $cursor->row() < $this->height)
            && ($cursor->col() >= 0 && $cursor->col() < $this->width);
    }
}