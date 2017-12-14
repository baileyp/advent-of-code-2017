<?php

namespace App\Solution;

use App\Model\StdinReader;

class Day14Solution extends AbstractSolution
{
    public function part1(): string
    {
        $keyString = $this->inputReader->readLine();

        $usedSquares = 0;

        for ($row = 0; $row < 128; $row++) {
            $knotHash = (new Day10Solution(new StdinReader("$keyString-$row")))->part2();

            $usedSquares += $this->countUsed($this->knotHashToBits($knotHash));
        }

        return $usedSquares;
    }
    
    public function part2(): string
    {
        $keyString = $this->inputReader->readLine();

        $grid = [];

        for ($row = 0; $row < 128; $row++) {
            $knotHash = (new Day10Solution(new StdinReader("$keyString-$row")))->part2();

            $bits = $this->knotHashToBits($knotHash);

            $grid[] = str_split($bits);
        }

        return $this->countUsedRegions($grid);
    }

    /**
     * Count the number of regions of used squares in the grid
     *
     * @param $grid
     * @return int
     */
    private function countUsedRegions($grid): int
    {
        $count = 0;

        for ($row = 0; $row < count($grid); $row++) {
            for ($col = 0; $col < count($grid[$row]); $col++) {
                if ($grid[$row][$col] === '1') {
                    $count++;
                    $this->dfsVisit($grid, $row, $col);
                }
            }
        }

        return $count;
    }

    /**
     * Visit the square at $row, $col and all adjacent neighbors. Visiting a square consists of switching the bit from
     * "used" to "free" i.e., 1 to 0
     *
     * @param array $grid
     * @param int $row
     * @param int $col
     */
    private function dfsVisit(array &$grid, int $row, int $col): void
    {
        // Out of bounds = nothng to do
        if (!array_key_exists($row, $grid) || !array_key_exists($col, $grid[$row])) {
            return;
        }
        // Not visitable
        if ($grid[$row][$col] === '0') {
            return;
        }
        // Visit this bit then visit each of its adjacent neighbors
        $grid[$row][$col] = '0';
        $this->dfsVisit($grid, $row, $col - 1);
        $this->dfsVisit($grid, $row, $col + 1);
        $this->dfsVisit($grid, $row - 1, $col);
        $this->dfsVisit($grid, $row + 1, $col);
    }

    /**
     * Convert a knot hash to a string of bits
     *
     * @param string $knotHash
     * @return string
     */
    private function knotHashToBits(string $knotHash): string
    {
        $bits = '';
        for ($i = 0; $i < strlen($knotHash); $i++) {
            $bits .= str_pad(base_convert($knotHash{$i}, 16, 2), 4, '0', STR_PAD_LEFT);
        }
        return $bits;
    }

    /**
     * Count the number of used bits in a string of bytes. A bit is considered used if
     * @param string $bits
     * @return int
     */
    private function countUsed(string $bits): int
    {
        return substr_count($bits, '1');
    }
}