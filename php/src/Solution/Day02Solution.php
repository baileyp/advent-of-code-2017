<?php

namespace App\Solution;

class Day02Solution extends AbstractSolution
{
    public function part1(): string
    {
        $checksum = 0;

        while ($line = $this->inputReader->readLine()) {
            $checksum += $this->calclulateRowDiff($this->rowToNumbers($line));
        }

        return $checksum;
    }

    public function part2(): string
    {
        $checksum = 0;

        while ($line = $this->inputReader->readLine()) {
            $checksum += $this->findDifference($this->rowToNumbers($line));
        }

        return $checksum;
    }

    /**
     * Convert the raw input into an array of integers
     *
     * @param string $row
     * @return array
     */
    private function rowToNumbers(string $row) : array
    {
        return array_map('intval', explode("\t", $row));
    }

    /**
     * Find two integers in the cells that evenly divide and return their quotient
     *
     * @param array $cells
     * @return int
     */
    private function findDifference(array $cells): int
    {
        foreach ($cells as $number) {
            if ($divisor = $this->findDivisor($number, $cells)) {
                return $number / $divisor;
            }
        }
        return 0;
    }

    /**
     * Fine a whole-number divisor
     *
     * @param int $number
     * @param array $possibleDivisors
     * @return int
     */
    private function findDivisor(int $number, array $possibleDivisors): int
    {
        foreach ($possibleDivisors as $divisor) {
            if ($number !== $divisor && is_int($number / $divisor)) {
                return $divisor;
            }
        }
        return 0;
    }

    /**
     * Find the min/max integers in the cells and return their difference
     *
     * @param array $cells
     * @return int
     */
    private function calclulateRowDiff(array $cells): int
    {
        $min = PHP_INT_MAX;
        $max = PHP_INT_MIN;

        foreach ($cells as $number) {
            if ($number < $min) {
                $min = $number;
            }
            if ($number > $max) {
                $max = $number;
            }
        }

        return $max - $min;
    }
}